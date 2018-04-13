<?php

require_once 'miscellaneous/Backup.php';    

		$tp = SJB_System::getTemplateProcessor();
		$action = SJB_Request::getVar('action', false);
		$dir_separator = DIRECTORY_SEPARATOR;
		$script_path = array_shift(explode(SJB_System::getSystemSettings('SYSTEM_URL_BASE'), __FILE__));
		$identifier = SJB_Request::getVar('identifier', time());

		switch ($action) {

			case 'backup':
				if (SJB_System::getSystemSettings('isDemo')) {
					SJB_Session::setValue('error', 'Error: You don\'t have permissions for it. This is a Demo version of the software.');
					break;
				}

				if (getenv('SJB_APPLICATION_MODE') == 'trial') {
					SJB_Session::setValue('error', 'Error: You don\'t have permissions for it. This is a Trial version of the software.');
					break;
				}

				SessionStorage::destroy('backup_' . $identifier);
				SessionStorage::write('backup_' . $identifier, serialize(array('last_time' => time())));
				SJB_Session::unsetValue('restore');
				SJB_Session::unsetValue('error');
				$backup_type = SJB_Request::getVar('backup_type');
				$backupDir = $script_path . 'backup' . $dir_separator;
				if (!is_dir($backupDir)) {
					mkdir($backupDir, 0777);
				}
				if (!file_exists($backupDir . '.htaccess')) {
					$handle = fopen($backupDir . '.htaccess', 'a');
					$text = '<FilesMatch ".*">
    Order allow,deny
    Deny from all
    Satisfy All
</FilesMatch>';
					fwrite($handle, $text);
					fclose($handle);
					die;
				}
				switch ($backup_type) {

					case 'full':
						SessionStorage::write('backup_' . $identifier, serialize(array('last_time' => time())));
						$backupDir = $script_path;
						$name = 'db.sql';

						SJB_Backup::dump($name, $script_path, $identifier);

						$d = dir($script_path);
						$contentDir = array();
						$folders = array('.', '..', 'backup', '.svn', '.settings', '.cache', 'restore');
						while (false !== ($entry = $d->read())) {
							if (!in_array($entry, $folders)) {
								$contentDir[] = $entry;
							}
						}
						$listFilesAndFolders = !empty($contentDir) ? $contentDir : false;
						$backupName = 'full_backup_' . date('Y_m_d__H_i') . '.tar.gz';
						$export_files_dir_name = '..' . $dir_separator;
						if (SJB_Backup::archive($name, $listFilesAndFolders, $backupDir, $export_files_dir_name, $backupName, true, $identifier, 'full'))
							SessionStorage::write('backup_' . $identifier, serialize(array('name' => $backupName)));
						exit();
						break;

					case 'database':
						SessionStorage::write('backup_' . $identifier, serialize(array('last_time' => time())));
						$name = 'db.sql';
						$backupName = 'mysqldump_' . date('Y_m_d__H_i') . '.tar.gz';
						$export_files_dir_name = '../backup' . $dir_separator;
						SJB_Backup::dump($name, $script_path, $identifier);
						if (SJB_Backup::archive(false, $name, $script_path, $export_files_dir_name, $backupName, false, $identifier, 'database'))
							SessionStorage::write('backup_' . $identifier, serialize(array('name' => $backupName)));
						exit();
						break;

					case 'files':
						SessionStorage::write('backup_' . $identifier, serialize(array('last_time' => time())));
						$backupDir = $script_path;
						$d = dir($script_path);
						$contentDir = array();


						$folders = array('.', '..', 'backup', '.svn', '.settings', '.cache', 'restore');
						while (false !== ($entry = $d->read())) {
							if (!in_array($entry, $folders))
								$contentDir[] = $entry;
						}
						$listFilesAndFolders = !empty($contentDir) ? $contentDir : false;
						$backupName = 'backup_' . date('Y_m_d__H_i') . '.tar.gz';
						$export_files_dir_name = '..' . $dir_separator;
						if (SJB_Backup::archive(false, $listFilesAndFolders, $backupDir, $export_files_dir_name, $backupName, true, $identifier, 'files'))
							SessionStorage::write('backup_' . $identifier, serialize(array('name' => $backupName)));
						exit();
						break;
				}
				break;

			case 'restore':
				require_once "Archive/Tar.php";
				if (SJB_System::getSystemSettings('isDemo')) {
					SJB_Session::setValue('error', 'Error: You don\'t have permissions for it. This is a Demo version of the software.');
					exit();
				}

				if (getenv('SJB_APPLICATION_MODE') == 'trial') {
					SJB_Session::setValue('error', 'Error: You don\'t have permissions for it. This is a Trial version of the software.');
					exit();
				}

				SJB_Session::unsetValue('restore');
				SJB_Session::unsetValue('error');

				$error = false;
				$file = $_FILES['restore_file']['tmp_name'];
				$fileName = $_FILES['restore_file']['name'];
				$restoreDir = $script_path . 'restore' . $dir_separator;
				if (!is_dir($restoreDir)) {
					mkdir($restoreDir, 0777);
				}
				move_uploaded_file($file, $restoreDir . $fileName);

				$tar = new Archive_Tar($restoreDir . $fileName, 'gz');
				$tar->_error_class = 'SJB_PEAR_Exception';
				try {
					$tar->extractList('db.sql', $restoreDir);
					$tar->extract($script_path);
					if (is_file($restoreDir . 'db.sql')) {
						SJB_Backup::restore_base_tables($restoreDir . 'db.sql');
					}
				}
				catch (Exception $ex) {
					$error = $ex->getMessage();
				}
				SJB_Filesystem::delete($restoreDir);
				if (is_file($script_path . 'install.php'))
					SJB_Filesystem::delete($script_path . 'install.php');
				if ($error)
					SJB_Session::setValue('error', $error);
				else
					SJB_Session::setValue('restore', 1);
				exit();
				break;

			case 'send_archive':
				$name = SJB_Request::getVar('name', false);
				$archive_file_path = SJB_Path::combine(SJB_BASE_DIR.'backup' . $dir_separator, $name);
				if ($name)
					SJB_Backup::sendArchiveFile($name, $archive_file_path);
				break;

			case 'check':
				$sessionBackup = SessionStorage::read('backup_' . $identifier);
				$sessionBackup = $sessionBackup ? unserialize($sessionBackup) : array();
				$sessionRestore = SJB_Session::getValue('restore');
				$sessionError = SJB_Session::getValue('error');
				if (!empty($sessionBackup['name'])) {
					$name = $sessionBackup['name'];
					SessionStorage::destroy('backup_' . $identifier);
					echo SJB_System::getSystemSettings('SITE_URL') . "/backup/?action=send_archive&name={$name}";
					exit();
				}
				elseif (!empty($sessionRestore)) {
					SJB_Session::unsetValue('restore');
					echo SJB_System::getSystemSettings('SITE_URL') . '/backup/#restore';
					exit();
				}
				elseif (!empty($sessionError)) {
					echo 'Error';
					if (SJB_System::getSystemSettings('isDemo')) {
						echo ': You don\'t have permissions for it. This is a Demo version of the software.';
					}
					if (getenv('SJB_APPLICATION_MODE') == 'trial') {
						echo ': You don\'t have permissions for it. This is a Trial version of the software.';
					}
					exit();
				}
				elseif (!empty($sessionBackup['last_time'])) {
					$period = (time() - $sessionBackup['last_time']) / 60;
					if ($period < 5)
						echo 1;








					else {
						SJB_Session::setValue('error', 'The backup generation process was unexpectedly interrupted. Please try again.');
						echo 'error';
					}
					exit();
				}
				else
					echo 1;
				exit();
				break;

			case 'delete_backup':
				$name = SJB_Request::getVar('name', false);
				$errors = array();
				if ($name) {
					$backup = $script_path . 'backup' . $dir_separator . $name;
					if (is_file($backup)) {
						SJB_Filesystem::delete($backup);
					}
					else {
						$errors['FILE_NOT_FOUND'] = 1;
					}
				}
				$tp->assign('errors', $errors);
				$tp->assign('delBackup', 1);

			case 'created_backups':
				$path = $script_path . 'backup' . $dir_separator;

				if (is_dir($path)) {
					$di = new DirectoryIterator($path);
					$backupsArr = array();

					foreach ($di as $file) {
						$fileName = $file->getFilename();

						if (!$file->isDir() && !$file->isLink() && $fileName != '.htaccess') {
							$cTime = $file->getCTime();
							$backupsArr[$cTime]['name'] = $fileName;
							if (preg_match('/mysqldump/', $fileName))
								$backupsArr[$cTime]['type'] = 'Site database only';
							elseif (preg_match('/full_backup/', $fileName))
								$backupsArr[$cTime]['type'] = 'Full site backup';
							elseif (preg_match('/backup/', $fileName))
								$backupsArr[$cTime]['type'] = 'Site files only';
							else
								$backupsArr[$cTime]['type'] = 'Unknown';

							$pattern = '/(\w+)_(\d+)_(\d+)_(\d+)__(\d+)_(\d+).tar.gz/i';
							$replacement = '$2-$3-$4 $5:$6';
							$backupsArr[$cTime]['date'] = preg_replace($pattern, $replacement, $fileName);
						}
					}
					krsort($backupsArr);


					$tp->assign('created_backups', $backupsArr);
				}
				$tp->display('created_backups.tpl');
				exit();
				break;

			case 'error':
				$sessionError = SJB_Session::getValue('error');
				if (!is_null($sessionError)) {
					echo '<p class="error">' . $sessionError . '</p>';
					exit;
				}
				break;
		}
		$tp->assign('identifier', $identifier);
		$tp->display('backup.tpl');
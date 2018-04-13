<html>
  <head>
    <title>
      SmartJobBoard Admin Panel
      {if $TITLE ne ""} :: {$TITLE} {/if}
    </title>
    <link rel="StyleSheet" type="text/css" href="{image src="design.css"}">
  </head>
  <body>
    <center>
      <img src="{image src="logo.jpg"}" alt="SmartJobBoard"><br>
      <hr />
      <table class="mainMenuTable" cellpadding="0" cellspacing="0">
        <tr>
          <td valign="top">
          	{$MAIN_CONTENT}
            <table style="font-size:85%;font-family:tahoma;text-align:center;width:100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>
                  Copyright &copy; 2010 SmartJobBoard.com All rights reserved
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
    </center>
  </body>
</html>

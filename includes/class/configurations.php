<?php
/**
 * Database config variables
 */

define("HOST", "localhost");
define("USERNAME", "root");
define("PASSWORD", "root");
define("DATABASE", "sando");
define("PORT", "");
define("SOCKET", "/Applications/MAMP/tmp/mysql/mysql.sock");


/**
 * Messeges config variables
 */

define('MSG_FILL_ALL_DETAILS', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>ERROR:</strong> Please fill all required details.</div>');
define('MSG_CHECK_USERNAME','<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> Email address is already in the system!</div>');
define('MSG_REGISTER_SUCCESSFULLY', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Well done!  </strong> User registered successfully.</div>');
define('MSG_CLAIM_SUCCESSFULLY', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Well done!  </strong> User demand submited successfully.</div>');
define('MSG_UPDATE_SUCCESSFULLY', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Well done!  </strong> User updated successfully.</div>');
define('MSG_ACCEPTED_SUCCESSFULLY', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Well done!  </strong> Salary accepted successfully.</div>');
define('MSG_APPROVED_SUCCESSFULLY', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Well done!  </strong> Salary approved successfully.</div>');
define('MSG_REJECTED_SUCCESSFULLY', '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Well done!  </strong> Salary rejected successfully.</div>');
define('MSG_SEND_EMAIL_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!  </strong> We could not send an email to the email address you provided! Please contact Admin </strong></div>');
define('MSG_REGISTER_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> There is a problem while applying to join us</div>');
define('MSG_CLAIM_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> There is a problem while demanding your salary</div>');
define('MSG_UPDATE_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> There is a problem while updating your salary</div>');
define('MSG_ACCEPTED_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> There is a problem while accepting the salary</div>');
define('MSG_APPROVED_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> There is a problem while approving the salary</div>');
define('MSG_REJECTED_ERROR', '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Oops!</strong> There is a problem while reject the salary</div>');

define('ADMIN', 1);
define('MANAGER', 2);
define('SUPERVISOR', 3);
define('USER', 4);

define('PENDING', 0);
define('ACCEPTED', 1);
define('APPROVED', 2);
define('REJECTED', 3);


?>
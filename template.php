<?php 
	get_header();
	$current_user = wp_get_current_user();
	// show_admin_bar(false);
	$path = '../wp-content/themes/twentyeleven-child/';
	$inc = 'inc/';
	$ng = 'ngModules/';
	$ap = 'trainingScheduler/';
	$c = 'controllers/';
	
	// require_once( WP_PLUGIN_DIR . '/simple-ldap-login/adLDAP.php' );

	// $username='systemaccess'; 
	// $password='540EMain';

	// define( 'DOMAIN_CONTROLLERS', 	'stk540dc01.scsjc.com' );
	// define( 'SECURITY_MODE', 		'high' );
	// define( 'ACCOUNT_SUFFIX', 		'@scsjc.com' );
	// define( 'BASE_DN', 				'DC=scsjc,DC=com' );
	// define( 'USE_TLS',				false );
	// define( 'USE_SSL', 				false );

	// $adldap_options = array(
		// 'account_suffix'		=>	ACCOUNT_SUFFIX,
		// 'base_dn'				=>	BASE_DN,
		// 'use_tls'				=>	USE_TLS,
		// 'use_ssl'				=>	USE_SSL,
		// 'domain_controllers'	=>	explode( ';', DOMAIN_CONTROLLERS )
	// );

	// try {
		// $adldap = new adLDAP( $adldap_options );
	// }
	// catch (adLDAPException $e) {
		// echo $e; 
		// exit();   
	// }
?>

<!-- Foundation-->
<link rel="stylesheet" href="<?=$path.$inc?>/foundation-5.5.0/css/foundation.darkblue.min.css" />
<link rel="stylesheet" href="<?=$path.$inc?>/foundation-5.5.0/foundation-icons/foundation-icons.css" />

<!--css-->
<link rel="stylesheet" href="<?=$path.$inc.$ng?>/growlNotifications/angular-growl-foundation.css" />
<link rel="stylesheet" href="<?=$path.$inc.$ng?>/ngDialog/ngDialog.css" />
<link rel="stylesheet" href="<?=$path.$inc.$ng?>/ngDialog/ngDialog-theme-default.min.css" />
<link rel="stylesheet" href="<?=$path.$inc.$ng?>/angular-datepicker.min.css" />
<link rel="stylesheet" href="<?=$path.$inc.$ng?>/ngPickDate/angular-pickadate.css" />
<link rel="stylesheet" href="<?=$path.$ap?>/style.css" />

<!-- ngModules -->
<script type="text/javascript" src="<?=$path.$inc?>/angular.min.js"></script>
<script type="text/javascript" src="<?=$path.$inc.$ng?>/growlNotifications/angular-growl.min.js"></script>
<script type="text/javascript" src="<?=$path.$inc.$ng?>/angular-animate.js"></script>
<script type="text/javascript" src="<?=$path.$inc.$ng?>/ngDialog/ngDialog.min.js"></script>
<script type="text/javascript" src="<?=$path.$inc.$ng?>/angular-datepicker.min.js"></script>
<script type="text/javascript" src="<?=$path.$inc.$ng?>/ngPickDate/angular-pickadate.js"></script>
<?php /*
<link rel="stylesheet" href="<?=$path.$inc.$ng?>/ngPickDate - trainSched/angular-pickadate.css" />
<script type="text/javascript" src="<?=$path.$inc.$ng?>/ngPickDate - trainSched/angular-pickadate.js"></script>
*/ ?>


<!-- moment -->
<script type="text/javascript" src="<?=$path.$inc?>/moment.js"></script>
<script type="text/javascript" src="<?=$path.$inc.$ng?>/ngMoment/angular-moment.min.js"></script>	
	
<!--Foundation -->
<script type="text/javascript" src="<?=$path.$inc?>/mm-foundation-tpls-0.5.1.min.js"></script>

<!--App -->
<script type="text/javascript" src="<?=$path.$ap?>/app.js"></script>

<!-- controllers -->
<script type="text/javascript" src="<?=$path.$ap?>PageController.js"></script>
<script type="text/javascript" src="<?=$path.$ap?>RequestController.js"></script>
<script type="text/javascript" src="<?=$path.$ap?>CalendarController.js"></script>

<head><base href="/?page_id=1036/"></head>

<body ng-app="trainingScheduler" ng-controller="PageController as PageCtrl">
	<div growl></div>
	<div pickadate ng-model="request.date" default-date="request.date"></div>
	<!-- request form -->
	<div class="row" ng-controller="RequestController as RequestCtrl">		
		<div class="large-6 columns" >
			<form ng-submit="submitRequest(request)">
				<fieldset>
					<legend><h3>New</h3></legend>
					<div class="row">
						<label class="large-3 columns">Date:
							<input type="text" ng-model="request.date">
						</label>
						<label class="large-9 columns"> Employee:
							<input list="empNames" type="text"  ng-model="request.name" placeholder="e.g: John Smith">
						</label>
					</div>
					<div class="row">
						<label class="large-6 columns">Training:
							<select ng-model="request.training">
								<option value="FCE">Full Court Enterprise</option>
							</select>
						</label>
						<label class="large-6 columns"> Room:
							<select ng-model="request.location">
								<option value="3rd Floor Conference Room">3rd Floor Conference Room</option>
								<option value="Family Law">Family Law</option>
							</select>
						</label>
					</div>
					<input type="submit" style="margin-bottom:0px;" class="button right tiny">
				</fieldset>
			</form>
			<datalist id="empNames">
				<?php
					// if($adldap->authenticate($username, $password)){
						// $groupMembers = $adldap->group_members('All Superior Court Staff');
						
						// foreach ($groupMembers as $member) {
							// $isGUID = false;
							// $userinfo = $adldap->user_info($member, array("*"),$isGUID);
							// $dispname = $userinfo[0]['displayname'][0];
							// echo '<option value="'.$dispname.'">';
						// }
					// }
				?>
			</datalist>
		</div>
		
		<div class="large-3 columns" ng-repeat="(key, value) in attendance">
			<table  style="padding:0;margin:2.125rem 0;width:100%;" >
				<thead>
					<tr>
						<th>
							{{key}} - {{locCount(value)}}
						</th>
					</tr>
				</thead>
				<tbody>
					<tr ng-repeat="(k, v) in value">
						<td>{{v}} <i class="fi-x right" ng-click="deleteRequest(k, key)" style="cursor:pointer;"></i></td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</body>

<?php get_footer(); ?>
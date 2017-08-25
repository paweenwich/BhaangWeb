<?php
    date_default_timezone_set('America/Los_Angeles');
    session_start();
    include 'global.php';
    require_once('loginCredentials.php');
    $dbName = $_SESSION['DBNAME'];
    $accountID = $_SESSION['ACCOUNTID'];
    $accountName = $_SESSION['ACCOUNNAME'];
?>

<!-- ***************************************************
THIS PAGE USE  <ng-view>
editContactNewAudience.html
editContactAudience.html
*************************************************** -->

<!DOCTYPE html>
<html ng-app="myApp">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Audience</title>
    <!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<!-- Font awesome -->
	<link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- Main Inspinia CSS files -->
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<!-- Sweet alert -->
	 <script src="css/sweet/sweetalert-dev.js"></script>
	 <link rel="stylesheet" href="css/sweet/sweetalert.css">

	<!-- Angular -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/css/xeditable.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/angular-xeditable/0.8.0/js/xeditable.min.js"></script>
	<!-- Route -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/danialfarid-angular-file-upload/12.2.13/ng-file-upload-all.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.1.1/min/dropzone.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.4/angular-route.js"></script> 

</head>
<body class="">
    <div id="wrapper">
	<!-- left wrapper -->
	<div w3-include-html="leftWrapper.php"></div>
	<!-- /end left wrapper -->
	<div id="page-wrapper" class="gray-bg">
		<div class="row border-bottom">
				 <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
				<!-- top wrapper -->
				<div w3-include-html="topWrapper.php"></div>
				<!-- / top wrapper -->
				</nav>
		</div>	

<!-- content -->

<div ng-view></div>


<!--/ content -->           
			<div class="footer">
			<!-- footer -->
			<div w3-include-html="footer.php"></div>
			<!-- / footer -->			
			</div>
		</div><!--  end page-wrapper -->
</div>

    <!-- Mainly scripts -->
	<script src="js/w3data.js"></script>	
	<script>w3IncludeHTML();</script>
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script type="text/JavaScript" src="global.js?n=1"></script> 


    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <script src="js/plugins/pace/pace.min.js"></script>
	 
	 <!-- Page-Level Scripts -->
 	<script src="js/jquery.md5.js"></script>
	<script src="js/davinci.js"></script>
    <script>
        $(document).ready(function() {
			//angular.element('#myCtrl').scope.Load();
			$.ajax({
				url: 'getFieldList.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: '',                         
				type: 'get',
				success: function(json){										
					if (json.success) {
						FieldOption = json.fieldOption;						
					}					
				}
			 });

        });
		
		Array.prototype.getIndexByValue = function (name, value) {
				for (var i = 0, len=this.length; i <len; i++) {
					if (this[i][name]) {
						if (this[i][name] === value) {
							return i
						}
					}
				}
				return -1;
		};
		
		var OperatorOption = 
		"<option value=\"\" ></option>"+
		"<option value=\"After\" >After</option>"+
		"<option value=\"AfterEqual\" >AfterEqual</option>"+
		"<option value=\"Before\" >Before</option>"+
		"<option value=\"BeforeEqual\" >BeforeEqual</option>"+
		"<option value=\"Contains\" >Contains</option>"+
		"<option value=\"EndsWith\" >EndsWith</option>"+
		"<option value=\"Equal\" >Equal</option>"+
		"<option value=\"NotContains\" >NotContains</option>"+
		"<option value=\"NotEndsWith\" >NotEndsWith</option>"+
		"<option value=\"NotEqual\" >NotEqual</option>"+
		"<option value=\"NotStartsWith\" >NotStartsWith</option>"+
		"<option value=\"StartsWith\" >StartsWith</option>";

		var FieldOption = "";

		var counter = 1;

		var cid = getParameterByName("cid");
		var indx = -1; 
		var dbName = "<?php echo $dbName; ?>";
		var FArr = [] ; // filter Array
		var FOperator = ""; 

		var myApp = angular.module("myApp", ["ngRoute","xeditable","ngFileUpload"]);
		myApp.config(function($routeProvider) {
			$routeProvider
			.when("/", {
				templateUrl : "editContactAudience.html"
			})
			.when("/new", {
				templateUrl : "editContactNewAudience.html"
			});		 
		});

myApp.controller('myCtrl',['$scope','$http','Upload','$rootScope',function($scope,$http,Upload,$rootScope) {

						$scope.Reset = function() {
							  $scope.audience  = angular.copy($rootScope.master);
							  indx = $scope.audience.items.getIndexByValue('contactID',cid);						  
							  if(cid == 'new' || indx == -1){
								  $scope.audience.items.push({"contactID":"","LIST-NAME":"","LIST-COUNT":"0","LIST-DESCRIPTION":"","LIST-DEFINITION":"","LIST-HASH":"","contactDetail":"","LIST-ARRAY":FArr,"LIST-OPERATOR":FOperator});
							  }else{					 
								 $scope.item = $scope.audience.items[indx];
							  }
						};
						$scope.Load = function() {
							$http.get("/couchdb/" + dbName +'/audienceLists').then(function(response) {
								 $rootScope.master  = response.data; 
								 if (typeof $rootScope.master.items == 'undefined') {
								   $rootScope.master.items = [];
								 } 
								 $scope.Reset();
							});
						};
						$scope.Save = function() {							    
								okFilterClick("saveCount"); 
								$http.put('/couchdb/' + dbName +'/audienceLists',  $scope.audience).then(function(response){
									 $scope.Load();
									 //alert("Save success");
									 swal("Save Success", "", "success");
								});         
								$('#filterDiv').hide();
						};
						$scope.cancel = function() {
								window.location.href="audiences.php"; 
						};

						//  put value to item of angular
						$scope.myCopyItem = function (ItemName,data) {
							if(indx != -1)
								$scope.audience.items[indx][ItemName] = data; 
							else
								$scope.item[ItemName] = data; 
						};

						$scope.SaveCnt = function(scnt) {							
								$scope.myCopyItem('LIST-COUNT',scnt);
								$http.put('/couchdb/' + dbName +'/audienceLists',  $scope.audience).then(function(response){
									 $scope.Load();									 
								});         
						};
						$scope.Load();

}]);//myCtrl


myApp.controller('myNewCtrl',['$scope','$http','Upload','$rootScope',function($scope,$http,Upload,$rootScope) {

			$scope.Save = function() {						
						var LName = $('#LISTNAME').val();			//alert("LName = "+LName); 
						if(LName != ''){
							var keyword = LName+getCurrentDateTime();
							var conID = $.md5(keyword);      //alert(conID); 					
							$scope.LoadData(conID); 
						}
			};

			$scope.LoadData = function(contactID) {
				var LName = $('#LISTNAME').val();
				 var LCnt = $('#tmpCount').val();   //$('#LISTCOUNT').val();						 
				 var LDesc = $('#LISTDESCRIPTION').val();
				 var LDef = $('#LISTDEFINITION').val();
				 var LHash= $('#LISTIDHASH').val();
				 var LDetail = $('#contactDetail').val();				 
                $http.get("/couchdb/" + dbName +'/audienceLists').then(function(response) {
						 $rootScope.master  = response.data; 
						 if (typeof $rootScope.master.items == 'undefined') {
								$rootScope.master.items = [];
						 } 
						 $scope.audience  = angular.copy($rootScope.master);						 
						 $scope.audience.items.push({"contactID":contactID,"LIST-NAME":LName,"LIST-COUNT":LCnt,"LIST-DESCRIPTION":LDesc,"LIST-DEFINITION":LDef,"LISTID-HASH":LHash,"contactDetail":LDetail,"LIST-ARRAY":FArr,"LIST-OPERATOR":FOperator});
 						$scope.SaveDB(contactID); 
				},function(errResponse){
						if (errResponse.status == 404) {
							$scope.audience = {items:[]};
							$scope.audience.items.push({"contactID":contactID,"LIST-NAME":LName,"LIST-COUNT":LCnt,"LIST-DESCRIPTION":LDesc,"LIST-DEFINITION":LDef,"LISTID-HASH":LHash,"contactDetail":LDetail,"LIST-ARRAY":FArr,"LIST-OPERATOR":FOperator});
	 						$scope.SaveDB(contactID); 
						}
                });
            };
			$scope.SaveDB = function(cID) {					
						$http.put('/couchdb/' + dbName +'/audienceLists',  $scope.audience).then(function(response){
							 //alert("Save success");
							 swal("Save Success", "", "success");
							 window.location.href="editContact.php?cid="+cID; 
						});   
			};
			$scope.cancel = function() {
					window.location.href="audiences.php"; 
			};

}]); //myNewCtrl
	
			
		function okFilterClick(page) { //edit for ng-view get parameter to seperate page  [ page = new/saveCount/ ]
			    $('#altCnt').hide();	
				var table = document.getElementById('filterTable');
				var rowLength = table.rows.length;
				if (rowLength == 1) {
					//alert("Please set filter.");
					swal("Please set filter."); 
				} else {
					$('#itemCount').val(counter);
					var LISTDEFINITION = "";
					var form_data = $("#idForm").serialize();			
					$.ajax({
							url: 'createFilter.php', // point to server-side PHP script 
							dataType: 'json',  // what to expect back from the PHP script, if anything
							cache: false,
							contentType: false,
							processData: false,
							data: form_data,                         
							type: 'get',
							success: function(json){					
								if (json.success) {
									$('#tmpFilter').val(json.Filter);									
									$('#LISTDEFINITION').val(json.Filter);
									if(page!='new'){	
											angular.element(document.getElementById('myCtrl')).scope().myCopyItem('LIST-DEFINITION',json.Filter);
									}
									FArr = json.filterArray; 
									FOperator = json.CriteriaJoinOperator; 
									angular.element(document.getElementById('myCtrl')).scope().myCopyItem('LIST-ARRAY',json.filterArray);
									angular.element(document.getElementById('myCtrl')).scope().myCopyItem('LIST-OPERATOR',json.CriteriaJoinOperator);
									//$('#filterDiv').hide();
									CountClick(page); 
									
								}
							}
					});			
				}				
		}//end okFilterClick				

		function CountClick(saveCount) {
				var form_data = $("#idForm").serialize();		
				//alert(" val = "+ $('#LISTDEFINITION').val() ); 				
				$.ajax({
					url: 'countClick.php', // point to server-side PHP script 
					dataType: 'json',  // what to expect back from the PHP script, if anything
					cache: false,
					contentType: false,
					processData: false,
					data: form_data,                         
					type: 'get',
					success: function(json){					
						var count = "0"; 
						if (json.success) {
							count = json.count;
							$('#tmpCount').val(json.count);	
							if(saveCount == 'saveCount'){
								if(cid == 'new'){
										 $('#LISTCOUNT').val(json.count);
								  }else{								
										document.getElementById('cntclick').innerHTML = json.count;
										angular.element(document.getElementById('myCtrl')).scope().SaveCnt(json.count);						  
								  }
							}							
						}
						document.getElementById('cntLabel').innerHTML = count; 
						$('#altCnt').show();
						//alert (count+' Contact(s) found');
					}
				 });						  
		}//end CountClick

		function FilterClick() {
			$('#altCnt').hide();
			var table = document.getElementById('filterTable');
			var LISTDEFINITION = "";
			var form_data = $("#idForm").serialize();		
			//alert(form_data);
			$.ajax({
				url: 'showFilter.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'get',
				success: function(json){					
					if (json.success) {
						var JoinOperator = json.JoinOperator;
						if (JoinOperator == 'or') {
							$("#joinrowor").attr("checked", true);
						} else {
							$("#joinrowand").attr("checked", true);
						}
						$('#filterTable > tbody').html(json.tabData);
						counter = json.counter;
						$('#filterDiv').show();
//						alert(json.filterArray); 
						FArr = json.filterArray; 
						FOperator = json.CriteriaJoinOperator; 
					}
				}
			 });				
		}

		function AddRow() {
			var tabData = "<tr>"+
			"<td>"+counter+"<input type=\"hidden\" name=\"rownumber"+counter+"\" id=\"rownumber"+counter+" value='"+counter+"'\"></td>"+
			"<td><select name=\"fieldoption"+counter+"\" id=\"fieldoption"+counter+"\">"+FieldOption+"</select></td>"+
			"<td><select name=\"operatoroption"+counter+"\" id=\"operatoroption"+counter+"\">"+OperatorOption+"</select></td>"+
			"<td><input type=\"text\" name=\"filtervalue"+counter+"\" id=\"filtervalue"+counter+"\"></td>"+
			"<td><input type=\"button\" value=\"Del\" onclick=\"delRow(this,"+counter+")\"></td>"+
			"</tr>";
			$('#filterTable > tbody').append(tabData); 		
			counter++;			
		}

		function delRow(row, index) {
			var rowCount = $('#filterTable tr').length;			
			if (index == rowCount) {
				counter--;
			} else if (rowCount == 2) {
				counter = 1;
			}
			$(row).closest('tr').remove();			
		}

    </script>
	

</body>

</html>
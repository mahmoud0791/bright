
  <script>

    var formApp = angular.module('formApp', []);

    function formController($scope, $http) {

      $scope.formData = {};

      $scope.processForm = function() {
        $http({
              method  : 'POST',
              url     : "<?= \yii\helpers\Url::to(['users/login']); ?>",
              data    : $.param($scope.formData),  
              headers : { 'Content-Type': 'application/x-www-form-urlencoded' } 
          })
              .success(function(data) {
                  if (!data.success) {
                      $scope.errorEmail = data.email;
                  } else {
                      $scope.message = data.message;
                      $scope.errorEmail = '';
                  }
              });
      };
    }
  </script>

<div class="col-md-6 col-md-offset-3">

  <div class="page-header">
    <h1><span class="glyphicon glyphicon-lock"></span> Login</h1>
  </div>

   <div class="alert alert-success" role="alert" ng-show="message">{{ message }}</div>

  <form ng-submit="processForm()">
    <div id="name-group" class="form-group" ng-class="{ 'has-error' : errorEmail }">
      <label>Email</label>
      <input type="email" name="email" class="form-control"  ng-model="formData.email" required>
                        
    </div>

    <div id="superhero-group" class="form-group" ng-class="{ 'has-error' : errorEmail }">
      <label>Password</label>
      <input type="password" name="password" class="form-control"  ng-model="formData.password">
    </div>

    <button type="submit" class="btn btn-success btn-lg btn-block">
      <span class="glyphicon glyphicon-flash"></span> Submit!
    </button>
  </form>

 <div class="alert alert-danger" role="alert" ng-show="errorEmail">{{ errorEmail }}</div>


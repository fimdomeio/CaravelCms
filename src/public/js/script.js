 "use strict";
(function(){
	var app = angular.module('caravel', ['ui.bootstrap', 'angular-loading-bar', 'restangular']);
  
	app.directive("mainNavigation", function() {
    return {
      restrict:"E",
      templateUrl: "/elements/mainNavigation.html",
      controller: function($scope, Restangular){
        Restangular.oneUrl('whoAmI', '/api/users/whoami').get().then(function(user){
          $scope.user = user;
        })
      }
    };
  });


  app.directive("caravelIssues", function() {
    return {
      restrict:"E",
      templateUrl: "/elements/caravelIssues.html",
      controller: function($scope, Restangular){
      		$scope.issues =	[];
      		$scope.loading = 'Loading...'
      		// /admin/api/caravel/issues
      		var issuesQ = Restangular.all('admin/api/caravel/issues');

					// This will query /accounts and return a promise.
					issuesQ.getList().then(function(issuesList) {
					  $scope.issues = issuesList;
					  $scope.loading = '';
					});
      },
      controllerAs: 'issues'
    };
  });

})();
 "use strict";
(function(){
	var app = angular.module('caravel', ['ui.bootstrap', 'angular-loading-bar', 'restangular']);

  app.controller('AuthorizationCtrl', function($scope, Restangular){

    $scope.authorized = false;

    $scope.isauthorized = function(){
      console.log('called');
      Restangular.oneUrl('isAuthorized', '/users/isAuthorized').get().then(function(isauth) {
          console.log(isauth);
          if(!isauth.authorized){
            window.location.replace("/login");
          }
          $scope.authorized = isauth.authorized;
        });
    }

  });
  

	app.directive("mainNavigation", function() {
    return {
      restrict:"E",
      templateUrl: "/admin/elements/mainNavigation.html"
    };
  });

	app.controller('DropdownCtrl', function ($scope, $log) {
  $scope.items = [
    'The first choice!',
    'And another choice for you.',
    'but wait! A third!'
  ];

  $scope.status = {
    isopen: false
  };

  $scope.toggled = function(open) {
    $log.log('Dropdown is now: ', open);
  };

  $scope.toggleDropdown = function($event) {
    $event.preventDefault();
    $event.stopPropagation();
    $scope.status.isopen = !$scope.status.isopen;
  };
});

  app.directive("caravelIssues", function() {
    return {
      restrict:"E",
      templateUrl: "/admin/elements/caravelIssues.html",
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
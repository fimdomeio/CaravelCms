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
      		var issuesQ = Restangular.all('api/issues/github');

					// This will query /accounts and return a promise.
					issuesQ.getList().then(function(issuesList) {
					  $scope.issues = issuesList;
					  $scope.loading = '';
					});
      },
      controllerAs: 'issues'
    };
  });

  app.directive("caravelMessages", function() {
    return {
      restrict:"E",
      templateUrl: "/elements/caravelMessages.html",
      controller: function($scope, Restangular){
        Restangular.oneUrl('messages', '/api/caravelmessages/').get().then(function(messages){
          $scope.messages = messages.msg;
        });
        var closeAlert = function(index){
          $scope.messages.splice(index, 1);
        }

      }
    };
  });


})();
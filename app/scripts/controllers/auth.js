'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('AuthCtrl', function ($scope, $http, $routeParams, $localStorage, $location) {
 //initially set those objects to null to avoid undefined error

    $scope.user = {}
    $scope.doLogin = function (user) {


        var res = $http.post('/api/index.php/login', user);
        res.success(function(data, status, headers, config) {
            $localStorage.currentUser = data.username;
            $localStorage.token = data.token;
            $location.path('/');
        }).
          error(function(data, status, headers, config) {
            window.alert("Wrong credentials, try again.");
        });

    };

    
    $scope.newUser= {};

    $scope.doSignup = function (newUser) {
        if(newUser.password == newUser.password2) {
            var res = $http.post('/api/index.php/signup', newUser);
            res.success(function(data, status, headers, config) {
                $localStorage.currentUser = data.username;
                $localStorage.token = data.token;
                $location.path('/blogs/');
            }).
              error(function(data, status, headers, config) {
                window.alert("Something went wrong, try again.", data, status, headers, config);
            });
        } else {
            window.alert("Passwords are not equals, try again.");
        }

        

    };



    $scope.logout = function () {
        $localStorage.currentUser = {};
        $localStorage.token = {};
        $location.path('/');
    }
});


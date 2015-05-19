'use strict';

/**
 * @ngdoc overview
 * @name blogApp
 * @description
 * # blogApp
 *
 * Main module of the application.
 */
angular
  .module('blogApp', [
    'ngAnimate',
    'ngCookies',
    'ngResource',
    'ngRoute',
    'ngSanitize',
    'ngTouch',
    'ngStorage',
    'ui.bootstrap',
  ])
  .config(function ($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'views/main.html',
        controller: 'MainCtrl'
      })
      .when('/blogs/:blogId', {
        templateUrl: 'views/blog.html',
        controller: 'BlogCtrl'
      })      
      .when('/blogs/:blogId/posts/:postId', {
        templateUrl: 'views/blogPost.html',
        controller: 'BlogPostCtrl'
      })
      .when('/login', {
        templateUrl: 'views/login.html',
        controller: 'AuthCtrl'
      })
      .when('/signup', {
        templateUrl: 'views/signup.html',
        controller: 'AuthCtrl'
      })
      .when('/logout', {
        templateUrl: 'views/login.html',
        controller: 'AuthCtrl'
      })
      .when('/createBlog', {
        templateUrl: 'views/createBlog.html',
        controller: 'BlogCtrl'
      })
      .when('/newPost', {
        templateUrl: 'views/createPost.html',
        controller: 'NewBlogPostCtrl'
      })
      .otherwise({
        redirectTo: '/'
      });
  })
 .controller("IndexCtrl", ["$scope", "$localStorage", "$location", function ($scope, $localStorage, $location) {
    $scope.isLoggedIn = function () {
      if($localStorage.currentUser) {
        return true;
      }
      return false;
    };
    $scope.logout = function () {
      $localStorage.$reset();
      $location.path('/blogs');
 
    };


    $scope.switchStyle = function() {
      console.log("asdf");
      if($scope.navbarStyle == "navbar-default") {
        $scope.navbarStyle = "navbar-inverse";

      }else {
        $scope.navbarStyle = "navbar-default";
      }
    };

    $scope.itemClicked = function ($index) {
      $scope.selectedIndex = $index;
    };

   $scope.navbarStyle = "navbar-inverse";


}]);




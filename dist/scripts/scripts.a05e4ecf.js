"use strict";angular.module("blogApp",["ngAnimate","ngCookies","ngResource","ngRoute","ngSanitize","ngTouch"]).config(["$routeProvider",function(a){a.when("/",{templateUrl:"views/main.html",controller:"MainCtrl"}).when("/about",{templateUrl:"views/about.html",controller:"AboutCtrl"}).otherwise({redirectTo:"/"})}]),angular.module("blogApp").controller("MainCtrl",["$scope","$http",function(a,b){function c(a){return{status:a,statusText:"Internal Server Error",description:"No details available"}}a.awesomeThings=[],a.loading=!0,b({method:"GET",url:"/api/index.php/features"}).success(function(d){a.loading=!1,a.awesomeThings=d,a.awesomeThings.forEach(function(a){a.loading=!0,b({method:"GET",url:a.href}).success(function(b){a.loading=!1,a.description=b.description}).error(function(b,d){a.loading=!1,a.error=b&&b.description?b:c(d)})})}).error(function(b,d){a.loading=!1,a.error=b&&b.description?b:c(d)})}]),angular.module("blogApp").controller("AboutCtrl",["$scope","$http",function(a,b){function c(a){return{status:a,statusText:"Internal Server Error",description:"No details available"}}a.awesomeThings=[],a.loading=!0,b({method:"GET",url:"/api/features"}).success(function(d){a.loading=!1,a.awesomeThings=d,a.awesomeThings.forEach(function(a){a.loading=!0,b({method:"GET",url:a.href}).success(function(b){a.loading=!1,a.description=b.description}).error(function(b,d){a.loading=!1,a.error=b&&b.description?b:c(d)})})}).error(function(b,d){a.loading=!1,a.error=b&&b.description?b:c(d)})}]);
'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('NewBlogPostCtrl', function ($scope, $http, $routeParams, $location) {


    $scope.newPost={};
    $scope.doCreate = function (newPost) {

        var res = $http.post('/api/index.php/newPost', newPost);
        res.success(function(data, status, headers, config) {
/*          $location.path('/blogs/' + $routeParams.blogId + '/posts' + data.idPost);
*/
        });
    };

    $scope.images=[]
    $scope.newImage={};
    $scope.addImage = function (newImage) {
      $scope.images.push({
        name: $scope.newImage.name,
        link: $scope.newImage.link
        });

      $scope.newImage.name = "";
      $scope.newImage.link= "";
    };

    $scope.deleteImage = function (idx) {
      $scope.images.splice(idx, 1); 
    };


  });


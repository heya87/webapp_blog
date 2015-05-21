'use strict';

/**
 * @ngdoc function
 * @name blogApp.controller:MainCtrl
 * @description
 * # MainCtrl
 * Controller of the blogApp
 */
angular.module('blogApp')
  .controller('BlogPostCtrl', function ($scope, $http, $routeParams, $location) {

    var url = '/api/index.php/blogs/' + $routeParams.blogId + '/posts/' + $routeParams.postId;
    $http({method: 'GET', url: url}).
      success(function (data) {
      $scope.blogPost = data[0];
    });

	$http({method: 'GET', url: '/api/index.php/blogs/' + $routeParams.blogId}).
      success(function (data) {
      $scope.blog = data[0];
    });


  var url = '/api/index.php/blogs/' + $routeParams.blogId + '/posts/' + $routeParams.postId + '/comments/';
  $http({method: 'GET', url: url}).
    success(function (data) {
    $scope.comments= data;
  });


  var url = '/api/index.php/blogs/' + $routeParams.blogId + '/posts/' + $routeParams.postId + '/images/';
  $http({method: 'GET', url: url}).
    success(function (data) {
    $scope.images= data;
  });



    $scope.newComment= {};

    $scope.doComment = function (newComment) {

      newComment.postId = $routeParams.postId;
      var now = new Date().toISOString().slice(0, 19).replace('T', ' ');
      newComment.DateTime = now;
     

/*        var res = $http.post('/api/index.php/newComment',newComment);
        res.success(function(data, status, headers, config) {
        $location.path('/blogs/' + $routeParams.blogId + '/posts/' + $routeParams.postId;

        console.log(data);
      });*/


        var res = $http.post('/api/index.php/newComment', newComment);
        res.success(function(data, status, headers, config) {
          $location.path('/blogs/' + $routeParams.blogId + '/posts/' + $routeParams.postId);
          $scope.newComment= {};
          $scope.comments.push(data);
        });
    };


        $scope.direction = 'left';
        $scope.currentIndex = 0;


        $scope.setCurrentSlideIndex = function (index) {
            $scope.direction = (index > $scope.currentIndex) ? 'left' : 'right';
            $scope.currentIndex = index;
        };

        $scope.isCurrentSlideIndex = function (index) {
            return $scope.currentIndex === index;
        };

        $scope.prevSlide = function () {
            $scope.direction = 'left';
            $scope.currentIndex = ($scope.currentIndex < $scope.images.length - 1) ? ++$scope.currentIndex : 0;
        };

        $scope.nextSlide = function () {
            $scope.direction = 'right';
            $scope.currentIndex = ($scope.currentIndex > 0) ? --$scope.currentIndex : $scope.images.length - 1;
        };



  })

  .animation('.slide-animation', function () {
        return {
            beforeAddClass: function (element, className, done) {
                var scope = element.scope();

                if (className == 'ng-hide') {
                    var finishPoint = element.parent().width();
                    if(scope.direction !== 'right') {
                        finishPoint = -finishPoint;
                    }
                    TweenMax.to(element, 0.5, {left: finishPoint, onComplete: done });
                }
                else {
                    done();
                }
            },
            removeClass: function (element, className, done) {
                var scope = element.scope();

                if (className == 'ng-hide') {
                    element.removeClass('ng-hide');

                    var startPoint = element.parent().width();
                    if(scope.direction === 'right') {
                        startPoint = -startPoint;
                    }

                    TweenMax.fromTo(element, 0.5, { left: startPoint }, {left: 0, onComplete: done });
                }
                else {
                    done();
                }
            }
        };
    });




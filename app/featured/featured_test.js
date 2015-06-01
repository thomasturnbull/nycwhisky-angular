'use strict';

describe('myApp.featured module', function() {

  beforeEach(module('myApp.featured'));

  describe('featured controller', function(){

    it('should ....', inject(function($controller) {
      //spec body
      var featuredCtrl = $controller('FeaturedCtrl');
      expect(featuredCtrl).toBeDefined();
    }));

  });
});
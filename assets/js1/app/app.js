var app = angular.module('myApp', ['ui.bootstrap']);

app.filter('startFrom', function() {
    return function(input, start) {
        if(input) {
            start = +start; //parse to int
            return input.slice(start);
        }
        return [];
    }
});
app.controller('customersCrtl', function ($scope, $http, $timeout) {
    $http.get('assets/getEtranzact.php').success(function(data){
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        $scope.maxSize = 10;
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    $scope.create = function() {
        alert("working");
    };
});

app.controller('studentCrtl', function ($scope, $http, $timeout, $modal, $log) {
    $("#spinner").show();
    $http.post('assets/getStudent.php').success(function(data){
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        $scope.maxSize = 10;
        $("#spinner").hide();
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    $scope.create = function(etti) {
        alert('student is ' +etti);
    };
    //$scope.items = ['item1', 'item2', 'item3'];

    $scope.open = function (size) {

    var p = size;

    $http.get('assets/student.php?name='+size).success(function(data){

      $scope.items = data;
      //alert(JSON.stringify($scope.items));
      //alert($scope.items);
      //max no of items to display in a page
      $scope.filteredI = $scope.items.length;
      $scope.items = {
    item: $scope.items[0]
      };
      $log.info($scope.items);
      //alert(JSON.stringify($scope.items));
    $log.info('Modal uploaded at: ' + $scope.filteredI);
  });
    
    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: 'ModalInstanceCtrl',
      size: size,
      resolve: {
        items: function () {
          //return $scope.items;
          return p;
        }
      }
    });

  
  modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
      //alert(new Date())
    },function () {
    
    });
    
  };
});
app.controller('ModalDemoCtrl', function ($scope, $modal, $log, $http) {

  $scope.items = ['item1', 'item2', 'item3'];

  $scope.open = function (size) {

    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: 'ModalInstanceCtrl',
      size: size,
      resolve: {
        items: function () {
          return $scope.items;
        }
      }
    });

    modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    });
  };
});
app.controller('ModalInstanceCtrl', function ($scope, $http, $modalInstance, items) {
  //alert(items);
  $http.get('assets/student.php?name='+items).success(function(data){

      $scope.lists = data;
      //max no of items to display in a page
      $scope.filteredItems = $scope.lists.length;
      //alert("hello "+$scope.etti+" "+$scope.lists);
      //return $scope.items;
      $scope.etti = {
    item: $scope.lists[0]
  };
  //alert("hello "+$scope.filteredItems);<img id="spinner" ng-src="img/spinner.gif" style="display:none;">
  }).error(function(data){
    alert("error occured");
  }
  );

  $scope.etti = items;
  /*$scope.selected = {
    item: $scope.items[0]
  };*/
  $scope.dart = {};

  $scope.proceed = function() {
      $http.post("assets/proceed.php",{'fstname': $scope.etti.item.othername, 'lstname': $scope.etti.item.name,'regn':$scope.etti.item.reg_no, 'prog_type':$scope.etti.item.prog_type, 'address':$scope.etti.item.address, 'phone':$scope.etti.item.phone,'dept':$scope.etti.item.dept, 'level':$scope.etti.item.level,'conf':$scope.dart.conf})
        .success(function(data, status, headers, config){
            alert(data);
            if(data == 'School fees where paid successfully'){
            console.log("inserted Successfully");
            $modalInstance.dismiss('cancel');}
        }).error(function(data){
          alert("error occured");
        });
        
  };

  $scope.ok = function () {
    $modalInstance.close($scope.selected.item);
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});


/*Manual Etranzact Controller*/
app.controller('etzCrtl', function ($scope, $http, $timeout, $modal, $log) {
    $("#spinner").show();
    $http.post('assets/getManual.php').success(function(data){
        $scope.list = data;
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        $scope.maxSize = 10;
        $("#spinner").hide();
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    $scope.create = function(etti) {
        alert('student is ' +etti);
    };
    //$scope.items = ['item1', 'item2', 'item3'];

    $scope.edit = function (size) {

    var p = size;
    //alert('student is ' +size);

    $http.get('assets/manual.php?name='+size).success(function(data){

      $scope.items = data;
      $scope.filteredI = $scope.items.length;
      $scope.items = {
    item: $scope.items[0]
      };
      $log.info($scope.items);
      //alert(JSON.stringify($scope.items));
    $log.info('Modal uploaded at: ' + $scope.filteredI);
  });
    
    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: 'ModalCtrl',
      size: size,
      resolve: {
        items: function () {
          //return $scope.items;
          return p;
        }
      }
    });

  
  modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
      //alert(new Date())
    },function () {
    
    });
    
  };
  $scope.delete = function (size) {

    var p = size;
    
    var modalInstance = $modal.open({
      templateUrl: 'myModalDelete.html',
      controller: 'ModaleCtrl',
      size: size,
      resolve: {
        items: function () {
          return p;
        }
      }
    });

  modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    },function () {
    
    });
    
  };
});

/*Modal Controller for manual fees*/
app.controller('ModalCtrl', function ($scope, $http, $modalInstance, items) {
  //alert(items);
  $("#spin").show();
  $http.get('assets/manual.php?id='+items).success(function(data){
      $("#spin").hide();
      $scope.lists = data;
      $scope.filteredItems = $scope.lists.length;
      $scope.etti = {
    item: $scope.lists[0]
  };
  }).error(function(data){
    alert("error occured");
  }
  );

  $scope.etti = items;
  $scope.dart = {};


  $scope.proceed = function() {
    $scope.dart.date = $("#edate").val();
  $scope.dart.i = $("#author").val();
  //alert($scope.dart.i);
      $http.post("assets/process.php",{'id': $scope.etti.item.id,'author': $scope.dart.i, 'edate': $scope.dart.date,'fullname': $scope.etti.item.fullname,'regn':$scope.etti.item.customer_id, 'receipt_no': $scope.etti.item.receipt_no, 'descr': $scope.etti.item.description,'prog_type':$scope.etti.item.prog_type, 'address':$scope.etti.item.address, 'phone':$scope.etti.item.phone,'dept':$scope.etti.item.dept, 'session':$scope.etti.item.session, 'level':$scope.etti.item.level,'conf':$scope.etti.item.confirm_code})
        .success(function(data, status, headers, config){
            alert(data);
            if(data == 'School fees where paid successfully'){
            console.log("inserted Successfully");
            $modalInstance.dismiss('cancel');}
        }).error(function(data){
          alert("error occured");
        });
        
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

/*Delete Modal for Manual Fees*/
app.controller('ModaleCtrl', function ($scope, $http, $modalInstance, items) {

  $scope.proceed = function() {
      $http.get("assets/delete.php?id="+items)
        .success(function(data, status, headers, config){
            alert(data);
            if(data == 'Payment Record has been deleted'){
            console.log("Deleted Successfully");
            $modalInstance.dismiss('cancel');}
        }).error(function(data){
          alert("error occured");
        });
        
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

/*Controller for Accomodation Table Page*/
app.controller('accCrtl', function ($scope, $http, $timeout, $modal, $log) {
    $("#spinner").show();
    $http.post('assets/accommodation.php').success(function(data){
        $scope.list = data;
        alert(data);
        $scope.currentPage = 1; //current page
        $scope.entryLimit = 10; //max no of items to display in a page
        $scope.filteredItems = $scope.list.length; //Initially for no filter  
        $scope.totalItems = $scope.list.length;
        $scope.maxSize = 10;
        $("#spinner").hide();
    });
    $scope.setPage = function(pageNo) {
        $scope.currentPage = pageNo;
    };
    $scope.filter = function() {
        $timeout(function() { 
            $scope.filteredItems = $scope.filtered.length;
        }, 10);
    };
    $scope.sort_by = function(predicate) {
        $scope.predicate = predicate;
        $scope.reverse = !$scope.reverse;
    };
    $scope.create = function(etti) {
        alert('student is ' +etti);
    };
    //$scope.items = ['item1', 'item2', 'item3'];

    $scope.edit = function (size) {

    var p = size;
    //alert('student is ' +size);

    $http.get('assets/accommodation.php?id='+size).success(function(data){

      $scope.items = data;
      $scope.filteredI = $scope.items.length;
      $scope.items = {
    item: $scope.items[0]
      };
      $log.info($scope.items);
      //alert(JSON.stringify($scope.items));
    $log.info('Modal uploaded at: ' + $scope.filteredI);
  });
    
    var modalInstance = $modal.open({
      templateUrl: 'myModalContent.html',
      controller: 'AcModalCtrl',
      size: size,
      resolve: {
        items: function () {
          //return $scope.items;
          return p;
        }
      }
    });

  
  modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
      //alert(new Date())
    },function () {
    
    });
    
  };
  $scope.delete = function (size) {

    var p = size;
    
    var modalInstance = $modal.open({
      templateUrl: 'myModalDelete.html',
      controller: 'aModalCtrl',
      size: size,
      resolve: {
        items: function () {
          return p;
        }
      }
    });

  modalInstance.result.then(function (selectedItem) {
      $scope.selected = selectedItem;
    }, function () {
      $log.info('Modal dismissed at: ' + new Date());
    },function () {
    
    });
    
  };
});

/*Modal Controller for manual fees*/
app.controller('AcModalCtrl', function ($scope, $http, $modalInstance, items) {
  //alert(items);
  $("#spin").show();
  $http.get('assets/accommodation.php?id='+items).success(function(data){
      $("#spin").hide();
      $scope.lists = data;
      $scope.filteredItems = $scope.lists.length;
      $scope.etti = {
    item: $scope.lists[0]
  };
  }).error(function(data){
    alert("error occured");
  }
  );

  $scope.etti = items;
  $scope.dart = {};


  $scope.proceed = function() {
    $scope.dart.date = $("#edate").val();
  $scope.dart.i = $("#author").val();
  //alert($scope.dart.i);
      $http.post("assets/postHostel.php",{'id': $scope.etti.item.id,'author': $scope.dart.i, 'edate': $scope.dart.date,'idno': $scope.etti.item.idno,'serial':$scope.etti.item.serial, 'pin': $scope.etti.item.pin, 'hostel': $scope.etti.item.hostel_name,'room':$scope.etti.item.room_no, 'space':$scope.etti.item.space})
        .success(function(data, status, headers, config){
            alert(data);
            if(data == 'Accommodation records were edited successfully'){
            console.log("inserted Successfully");
            $modalInstance.dismiss('cancel');}
        }).error(function(data){
          alert("error occured");
        });
        
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

/*Delete Modal for Manual Fees*/
app.controller('aModalCtrl', function ($scope, $http, $modalInstance, items) {

  $scope.proceed = function() {
      $http.get("assets/deleteHostel.php?id="+items)
        .success(function(data, status, headers, config){
            alert(data);
            if(data == 'Accommodation Record has been deleted'){
            console.log("Deleted Successfully");
            $modalInstance.dismiss('cancel');}
        }).error(function(data){
          alert("error occured");
        });
        
  };

  $scope.cancel = function () {
    $modalInstance.dismiss('cancel');
  };
});

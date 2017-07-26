(function($){
  $(document).ready(function(){
    var bk_fpd_img = $(".fpd-bottom-nav .fpd-add-image");
    var bk_fpd_dsn = $(".fpd-bottom-nav .fpd-add-design");
    console.log(bk_fpd_dsn.html(),bk_fpd_img.html());
    bk_fpd_img.html('UPLOAD PHOTO');
    bk_fpd_dsn.html('CHANGE PHOTO');
    // debugger;
  });

  // $bkfpd = document.querySelector('#fancy-product-designer-3297');
  // console.log(fpdIsReady, fancyProductDesigner,Date.now(), typeof $bkfpd);
  // var target = document.querySelector(".fpd-element-toolbar");
  //
  // // create an observer instance
  // observer = new MutationObserver(function(mutations) {
  //   mutations.forEach(function(mutation) {
  //     console.info(mutation.type,Date.now());
  //   });
  // });
  //
  // function addObserverIfDesiredNodeAvailable() {
  //     console.info("OBSERVER");
  //     var composeBox = document.querySelectorAll('.fpd-element-toolbar.fpd-show')[0];
  //     if(!composeBox) {
  //         //The node we need does not exist yet.
  //         //Wait 500ms and try again
  //         console.info("No node");
  //         window.setTimeout(addObserverIfDesiredNodeAvailable,500);
  //         return;
  //     }
  //     console.info("Got a node",fancyProductDesigner);
  //     $(".fpd-tool-edit-text").addClass('fpd-active');
  //     var config = { attributes: true, childList: true, characterData: true };
  //     observer.observe(composeBox,config);
  // }
  // //addObserverIfDesiredNodeAvailable();
  // $("#fancy-product-designer-3297").on('ready',function(e,c){
  //   console.info("Footer",e);
  //   $(".fpd-tool-edit-text").addClass('fpd-active');
  //   console.info("Footer2",fancyProductDesigner,fancyProductDesigner.toolbar,$selector);
  //   fancyProductDesigner.toolbar.toggle();
  // })

})(jQuery);

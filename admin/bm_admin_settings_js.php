<script>
    <?php global $script_domain; ?>
    // jQuery.ajax({url:"http://<?php echo $script_domain; ?>/launcher/config/wordpress.js?callback=bm_config",
    //              dataType:'jsonp',
    //              jsonp: false,
    //              jsonpCallback: "bm_config",
    //             success:function(d){console.log(d)  }
    //         });

    $ = jQuery;
    $(document).on('click','[data-target]',function() {
      $this = $(this)
      var target = $this.data('target')
      var reverse = $this.data('reverse')
      $par = $this.parents('.sub-section').first()
      if ($this.is(":checked")) {
        $('[data-type="' + target + '"]',$par).attr('disabled',true).removeAttr('checked').removeClass('disabled')
      }else {
        $('[data-type="' + target + '"]',$par).removeAttr('disabled').removeClass('disabled')
      }
    })

    $(document).on('click','[data-disable-all]',function() {
      $this = $(this)
      var reverse = $this.data('reverse')
      console.log(reverse)
      var $par = $this.parents('.sub-section').first()
      arr = $('input,select,label',$par)
      $arr = $($.grep(arr,function(e,i) {return  !$(e).data('disable-all')}))
      if ($this.is(":checked") ) {
        $arr.attr('disabled',!reverse)
        if (!reverse) {
          $arr.attr('checked',reverse)
        }
      }else {
        $arr.attr('disabled',reverse).attr('checked',!reverse)
        if (!reverse) {
          $arr.attr('checked',reverse)
        }
        // $arr.removeAttr('disabled')
      }
      $('[data-target]',$par).click();
    })

    $(document).on('click','[data-form-submit="true"]',function() {
      bm_form.submit();
    })
</script>
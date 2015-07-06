jQuery(document).ready( function($)
{
  var pubkey = quatricepsAjax.quatriceps_recaptcha_pubkey
  $('.quatriceps-generate').click(function()
  {
    var qid = '#' + $(this).parent('div').parent('div').attr('id')
    $(qid + ' .quatriceps-output').hide()
    n1 = Math.floor(Math.random() * 1000) + 1
    n2 = Math.floor(Math.random() * 1000) + 1
    if(n1 < n2)
    {
      // Switch values
      tmp = n1
      n1 = n2
      n2 = tmp
    }
    $(qid + ' .quatriceps-arg0').val(n1)
    $(qid + ' .quatriceps-arg1').val(n2)
  })

  $('.quatriceps-reveal').click(function()
  {
    var qid = '#' + $(this).parent('div').parent('div').attr('id')
    if($(qid + ' .quatriceps-arg0').val() == '')
    {
     alert('Please enter all required input.')
     return false;
    }
    if(pubkey.length)
    {
      if($('#recaptcha_challenge_image').length == 0)
      {
        recap_theme = quatricepsAjax.recaptcha_theme
        var recap_div = $(qid + ' .quatriceps-recaptcha').attr('id')
        Recaptcha.create(pubkey, recap_div, { theme: recap_theme })
        $(qid + ' .quatriceps-reveal').val('Submit Recaptcha')
        return false;
      }

      if($('#recaptcha_response_field').val() == '')
      {
        if($(qid + ' .quatriceps-recaptcha #recaptcha_area').length)
        {
          alert('Recaptcha challenge response required')
        }
        else
        {
          $('#recaptcha_area').appendTo(qid + ' .quatriceps-recaptcha')
        }
        return false;
      }
    }

    $(qid + ' .quatriceps-waiting').animate({opacity:1,height:'toggle'})
    $(qid + ' .quatriceps-output').animate({opacity:0,height:'toggle'})
    jQuery.ajax({
      type : 'get',
      url : quatricepsAjax.ajaxurl,
      dataType : 'jsonp',
      data: {
        action: "quatriceps_compute",
        id: quatricepsAjax.quatriceps_id,
        arg0: $(qid + ' .quatriceps-arg0').val(),
        arg1: $(qid + ' .quatriceps-arg1').val(),
        arg2: $(qid + ' .quatriceps-arg2').val(),
        arg3: $(qid + ' .quatriceps-arg3').val(),
        cmd:  $(qid + ' .quatriceps-cmd').val(),
        carry:  $(qid + ' .quatriceps-carry:checked').val(),
        pdf:  $(qid + ' .quatriceps-pdf:checked').val(),
        recaptcha_challenge_field: $('#recaptcha_challenge_field').val(),
        recaptcha_response_field: $('#recaptcha_response_field').val(),
      },
      success : function(data)
      {
        $(qid + ' .quatriceps-output-container').html('<div class="quatriceps-output">' + data.output + '</div><div class="quatriceps-pdf">' + data.pdf + '</div>')
        MathJax.Hub.Queue(["Typeset",MathJax.Hub, qid.substring(1,qid.length)]);
        $(qid + ' .quatriceps-waiting').animate({opacity:0, height:'toggle'})
        $(qid + ' .quatriceps-output').css('display', 'block')
        if(pubkey.length)
        {
          Recaptcha.reload_internal('t');
        }
      },
    })
    return false;
  })

}(jQuery));


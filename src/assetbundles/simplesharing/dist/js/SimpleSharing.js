/**
 * SimpleSharing plugin for Craft CMS
 *
 * SimpleSharing JS
 *
 * @author    reganlawton
 * @copyright Copyright (c) 2017 reganlawton
 * @link      https://hutsix.com.au
 * @package   SimpleSharing
 * @since     2.0.0
 */

var id = $("input[name='entryId']").val();
var sectionId = $("input[name='sectionId']").val();

if(id != null) {
  var uri = $.ajax({
    type: "GET",
    url: "/actions/simple-sharing/default/url?id=" + id + "&sectionId=" + sectionId,
    async: true
  }).done(function(res) {
    console.log(res);
  });


  if(uri) {
    $('#simple-sharing').remove();

    $("#settings").append(
      '<div id="simple-sharing" class="field" style="margin-top: 50px">' +
      '<div class="heading">' +
      '<label>Share Entry</label>' +
      '</div>' +
      '<div class="input ltr">' +
      '<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=' + uri + '">Facebook</a> | ' +
      '<a target="_blank" href="https://twitter.com/home?status=' + uri + '">Twitter</a> | ' +
      '<a target="_blank" href="https://plus.google.com/share?url=' + uri + '">Google</a>' +
      '</div>' +
      '</div>'
    );
  }
}
export default {
  init() {
    // JavaScript to be fired on all pages

    // Remove empty p tags
    $('p:empty').remove();

    // External links
    $('a').filter(function(){
        return this.hostname && this.hostname !== location.hostname;
    }).addClass('external').attr('target', '_blank');
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  }
};

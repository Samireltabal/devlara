function toast(title,message,color,icon,rtl,position){
    iziToast.show({
id: null, 
class: '',
title: title,
titleColor: '',
titleSize: '',
titleLineHeight: '',
message: message,
messageColor: '',
messageSize: '',
messageLineHeight: '',
backgroundColor: '',
theme: 'light', // dark
color: color, // blue, red, green, yellow
icon: icon,
iconText: '',
iconColor: '',
image: '',
imageWidth: 50,
maxWidth: null,
zindex: null,
layout: 2,
balloon: false,
close: true,
closeOnEscape: false,
closeOnClick: false,
rtl: rtl,
position: position, // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter, center
target: '',
targetFirst: true,
toastOnce: false,
replaceToast: false,
timeout: 10000,
animateInside: true,
drag: true,
pauseOnHover: true,
resetOnHover: false,
progressBar: true,
progressBarColor: '',
progressBarEasing: 'linear',
overlay: false,
overlayClose: false,
overlayColor: 'rgba(0, 0, 0, 0.6)',
transitionIn: 'fadeInUp',
transitionOut: 'fadeOut',
transitionInMobile: 'fadeInUp',
transitionOutMobile: 'fadeOutDown',
buttons: {},
inputs: {},
onOpening: function () {},
onOpened: function () {},
onClosing: function () {},
onClosed: function () {}
});
}

$(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-green',
      radioClass: 'iradio_square-green',
      increaseArea: '20%' /* optional */
    });
  });


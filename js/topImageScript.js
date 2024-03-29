 // Adjust content position based on image height
 ['load', 'resize'].forEach (evt =>
    window.addEventListener(evt, function() {
        var imageHeight = document.getElementById('topImage').offsetHeight;
        var navbarHeight = document.getElementById('navbar').offsetHeight;
        var overlayHeight = document.getElementById('overlay').offsetHeight;
        var vh = Math.max(document.documentElement.clientHeight || 0, window.innerHeight || 0);
        var offset //= Math.min(vh, imageHeight) - navbarHeight - overlayHeight;
        if(vh < imageHeight)
            offset = vh - navbarHeight - overlayHeight;
        else
            offset = imageHeight - overlayHeight;
        document.querySelector('.navbar').style.marginTop = offset + 'px';
      })
    );
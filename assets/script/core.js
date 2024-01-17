class core{
    url(segment = null){
        var urls = window.location.href;
        var url_sp = urls.split('/');
        var url = `${url_sp[0]}//${url_sp[2]}/${url_sp[3]}/`;
        if(segment){
            var r_url = `${url}${segment}`;
        }else{
            var r_url = url;
        }
        return r_url;
    }
    modal(label,url,button,color){
        $('.modal-title').html(label);
        $('#ModalLabelEdit').html(label);
        $('#ModalLabelDel').html(label);
        $('.modal-body form').attr('action',this.url(url));
        $('.modal-footer button[type=sumbit]').html(button);
        $('.modal-footer button[type=sumbit]').attr('class',color);
    }
}
export default class ajaxRequest {

    static post(data, url){
        return this.ajax(data, url, 'POST')
    }

    static get(data, url){
        return this.ajax(data, url, 'GET')
    }

    static ajax(data, url, type) {

        let token = $('body').data('csrf');
        if(Object.prototype.toString.call(data) === '[object Array]'){
            data.push({name: '_token', value: token })
        }else if(Object.prototype.toString.call(data) === '[object Object]'){
            data._token = token
        }else{
            console.log('Error: Something went wrong with sending data to ajaxRequest Class');
            return false;
        }

        return $.ajax({
            type: type,
            url: url,
            cache: false,
            data: data
        });
    }
}

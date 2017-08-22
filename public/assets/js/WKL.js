var WKL = {

    /**
     * Run Request
     *
     * @param url
     * @param type
     * @param params
     * @param synchronous
     * @param onComplete
     * @returns {*}
     */
    runRequest: function(url, type, params, synchronous, onComplete)
    {
        // Set response variable
        var response;

        // Run Ajax Call`
        jQuery.ajax({
            'async': ((typeof synchronous != 'undefined' && synchronous) ? true : false),
            'type': type,
            'global': false,
            'dataType': 'json',
            'data': params,
            'url': url,
            'complete': function (data) {
                response = data;
            }
        });

        if(typeof onComplete == 'function' && response)
        {
            var responseText = this.IsJsonString(response.responseText) ? response.responseText : null;

            onComplete(response, jQuery.parseJSON(responseText));
        }

        if(typeof response.responseText == 'undefined' || response.responseText == '' || !this.IsJsonString(response.responseText))
        {
            return false;
        }

        response = jQuery.parseJSON(response.responseText);

        if(typeof response == 'object')
        {
            return response
        }
        else
        {
            return false;
        }
    },

    /**
     * Is JSON String?
     *
     * @param data
     * @returns {boolean}
     * @constructor
     */
    IsJsonString: function(data)
    {
        try {
            JSON.parse(data);
        }
        catch (e) {
            return false;
        }

        return true;
    }
};
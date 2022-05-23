class JsSQL {

    constructor(callback) {
        this.url = './jsSql.php';
        this.callback = callback;
        this.query = ''
    }

    makeSelection(query) {
        const parametersAreValids = this.validation(query)

        if (parametersAreValids.error) {
            return parametersAreValids
        }

        this.query = query

        this.realizeFetch()
            .then(response => response.json())
            .then(json => this.callback(json))
            .catch(error => this.callback({
                error
            }))
    }

    realizeFetch() {
        const options = {
            method: 'POST',
            body: JSON.stringify({ query: this.query }),
            headers: {
                'Content-Type': 'application/json'
            }
        }

        return fetch(this.url, options)

    }

    validation(query) {
        if (!query) {
            return {
                error: true,
                description: 'The query is not valid'
            }
        } else if (!this.url) {
            return {
                error: true,
                description: 'The URL is not valid'
            }
        } else if (!this.callback || typeof this.callback !== 'function') {
            return {
                error: true,
                description: 'The Callback is not valid'
            }
        }
        return {
            error: false
        }
    }
}
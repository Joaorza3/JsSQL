<input type="text" id="query" placeholder="SELECT * FROM table" />
<button onclick="useSQL()">Usar SQL</button>

<script src="./js/jsSql.js"></script>
<script>
    const useSQL = () => {
        const jsSql = new JsSQL(myCallBackFunction)

        const query = document.getElementById('query').value

        jsSql.makeSelection(query)
    }

    function myCallBackFunction (response) {
        console.log(response)

        const data = response.data

        if (data && data.length > 0) {

            data.forEach(function(element) {
                console.log(element);
            });
        }

    }
</script>
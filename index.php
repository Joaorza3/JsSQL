<button onclick="getUsers()">getUsers</button>

<script src="./js/jsSql.js"></script>
<script>
    const getUsers = () => {
        const jsSql = new JsSQL(usersData)

        const query = 'SELECT * FROM unidade WHERE ativo_unidade = 1'

        jsSql.makeSelection(query)
    }

    function usersData (response) {
        console.log(response)

        const data = response.data

        if (data && data.length > 0) {

            data.forEach(function(element) {
                console.log(element);
            });
        }

    }
</script>
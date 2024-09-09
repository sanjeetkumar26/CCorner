 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Compiler</title>
    <style>
         body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.compiler-container {
    width: 100%;
    max-width: 800px;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.navbar-brand.logo {
    width: 200px;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

#code {
    width: 97%;
    height: 250px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-family: 'Courier New', Courier, monospace;
    margin-bottom: 20px;
    background-color: #f7f7f7;
}

select, button {
    display: block;
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

button {
    background-color:#ff6b00;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s;
}

button:hover {
    background-color: #dd5506;
}

#output {
    margin-top: 20px;
    padding: 15px;
    background-color: #e9e9e9;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-family: 'Courier New', Courier, monospace;
    white-space: pre-wrap;
}
.logo {
max-height: 50px;
}

    </style>
</head>
<body>
    <div class="compiler-container">
        <nav class="navbar">
            <h1>Code Practice</h1>
            <textarea id="code" placeholder="Write your code here..."></textarea>
            <select id="language">
                <option value="c">C</option>    
                <option value="cpp">C++</option>
                <option value="csharp">C#</option>
                <option value="python2">Python2</option>
                <option value="python3">Python3</option>
                <option value="java">Java</option>
                <option value="javascript">JavaScript</option>
                <option value="sql">SQL</option>

            </select>
            <button id="runCodeBtn">Run Code</button>
            <div id="output"></div>
        </nav>
    </div>
    <script>
        document.getElementById('runCodeBtn').addEventListener('click', function() {
            const code = document.getElementById('code').value;
            const language = document.getElementById('language').value;
            const outputDiv = document.getElementById('output');
            outputDiv.innerHTML = "Running your code...";

            fetch("http://localhost/ci/CI/index.php/compiler/execute_code", {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `code=${encodeURIComponent(code)}&language=${encodeURIComponent(language)}`
            })
            .then(response => response.text())
            .then(result => { outputDiv.innerHTML = result; })
            .catch(error => { outputDiv.innerHTML = `Error: ${error}`; console.error("Error:", error); });
        });
    </script>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-10 rounded-xl shadow-lg w-full max-w-xl">

        <h1 class="text-3xl font-bold mb-6 text-center">
            Search Dream Home
        </h1>

        <form action="{{ route('search.results') }}" method="GET">

            <input
                type="text"
                name="search"
                placeholder="Search properties, branches, clients..."
                class="w-full border border-gray-300 rounded-lg px-4 py-3 mb-4"
                required
            >

            <button
                type="submit"
                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition"
            >
                Search
            </button>

        </form>

    </div>

</body>
</html>
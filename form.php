<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Warehouse</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md bg-white p-8 rounded shadow-md">
        <h2 class="text-2xl font-semibold mb-6 text-center">Add New Warehouse</h2>
        <form action="table.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Name:</label>
                <input type="text" name="name" required class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Location:</label>
                <input type="text" name="location" required class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Capacity:</label>
                <input type="number" name="capacity" required class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Status:</label>
                <select name="status" class="mt-1 p-2 border border-gray-300 rounded w-full">
                    <option value="aktif">Aktif</option>
                    <option value="tidak_aktif">Tidak Aktif</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Opening Hour:</label>
                <input type="time" name="opening_hour" required class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Closing Hour:</label>
                <input type="time" name="closing_hour" required class="mt-1 p-2 border border-gray-300 rounded w-full">
            </div>
            <button type="submit" name="action" value="create" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Add Warehouse
            </button>
        </form>
    </div>
</body>
</html>

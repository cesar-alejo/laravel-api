<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-1 text-sm">
        <table>
            <tr>
                <th class="px-2">EXPIRATION</th>
                <th class="px-2">NAME</th>
                <th class="px-2">ARCHIVOS</th>
                <th class="px-2">USER</th>
                <th class="px-2">FECHA</th>
            </tr>
            <tr>
                <td class="px-2">{{ $file->expiration }}</td>
                <td class="px-2">{{ $file->name }}</td>
                <td class="px-2">{{ $file->details_count }}</td>
                <td class="px-2">{{ $file->user->name }}</td>
                <td class="px-2">{{ $file->created_at }}</td>
            </tr>
        </table>
    </div>
</div>

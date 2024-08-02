<div x-data="{ open: false }">
    <button @click="open = true">Expand</button>

    <span x-show="open">
        Content...
    </span>
    <script>
        let name = 'cesar';

        console.log(name);
    </script>
</div>

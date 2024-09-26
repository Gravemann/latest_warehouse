<template>
    <table class="w-full whitespace-nowrap">
        <thead class="bg-black/60">
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2"></th>
            <th class="text-left py-3 px-2 rounded-r-lg"></th>
        </thead>
        <tr class="border-b border-gray-700">
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2"></td>
            <td class="py-3 px-2">
                <ActionsComponent :order="order" />
            </td>
        </tr>
    </table>
</template>

<script>


export default {
}

</script>

<style>
    
</style>
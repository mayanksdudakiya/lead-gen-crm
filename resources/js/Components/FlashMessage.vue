<template>
    <div v-if="$page.props.flash.success">
        <div class="font-medium text-green-600">{{ $page.props.flash.success }}</div>
    </div>
</template>

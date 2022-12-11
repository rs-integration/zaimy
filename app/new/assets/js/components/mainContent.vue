<template>
    <div id="content">
        <div class="container">
            <div style="width:100%">
                <div id="geocredit_content">
                    <div class="geocredit_city"></div>
                    <div class="clr"></div>
                    <div class="clr"></div>
                    <div class="lead_text1">
                    </div>
                    <div class="clr"></div>
                    <div class="offers-block">
                        <organizations></organizations>
                    </div>
                </div>
            </div>
            <conditions-and-requirements></conditions-and-requirements>
        </div>
    </div>
</template>

<script>
    import organizations from "./organizations";
    import conditionsAndRequirements from "./conditionsAndRequirements";
    import mainFooter from "./mainFooter";

    export default {
        name: "mainContent",
        components: {
            organizations,
            conditionsAndRequirements,
        },
    }
</script>

<style scoped>

</style>

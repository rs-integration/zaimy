<template>
    <a class="bem_offer" :href="organization.link" @click.prevent="">
        <div class="link_offers">
            <div id="cr_block_new">
                <org-modify-buttons v-if="editmode" :orgKey="organization.sort" :index="index" />
                <div id="cr_img">
                    <img width="120" height="50" :src="organization.logo" alt="">
                </div>
                <div class="parallelogram__wrapper">
                    <org-label :label="organization.label" />
                </div>
                <div id="cr_cont">
                    <div id="cr_stb">
                        <div id="cr_p_new">
                            <span class="cr_pzag">
                                <img height="22" src="img/icon_s.png">
                            </span>
                            до {{ organization.maxSumm }} руб.
                        </div>
                        <div id="cr_p_new">
                            <span class="cr_pzag">
                                <img height="22" src="img/icon_pr.png">
                            </span>
                            от {{ organization.minPercent }}% в день</div>
                        <div id="cr_p_new">
                            <span class="cr_pzag">
                                <img height="22" src="img/icon_m.png">
                            </span>
                            от {{ organization.minAge }} до {{ organization.maxAge }} лет
                        </div>
                        <div id="cr_p5">Получить деньги</div>
                    </div>
                </div>
            </div>
        </div>
    </a>
</template>

<script>
    import orgLabel from "./orgLabel";
    import orgModifyButtons from "./orgModifyButtons";

    export default {
        name: "organization",
        props:['organization', 'editmode', 'index'],
        components: {orgLabel, orgModifyButtons},
    }
</script>

<style scoped>

</style>

<script setup>
import DynastyHeader from "@/Components/DynastyHeader.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import {toNumber} from "@vue/shared";
import Card from "@/Components/Card.vue";

defineProps({
    game: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AppLayout :title="`${game.season.dynasty.name} | View Game`" :selected_dynasty_id="game.season.dynasty.id">
        <DynastyHeader :dynasty="game.season.dynasty" />

        <h2 class="text-lg font-bold">
            {{ (game.type === 'Regular Season' ? 'Week ' + game.week : game.type) + ' ' + game.season.year }}
        </h2>

        <Card>
            <template #title>
                Box Score
            </template>

            <div class="grid grid-cols-7 gap-1 text-center">
                <div></div>
                <div class="pb-1 font-bold">1</div>
                <div class="pb-1 font-bold">2</div>
                <div class="pb-1 font-bold">3</div>
                <div class="pb-1 font-bold">4</div>
                <div class="pb-1 font-bold">OT</div>
                <div class="pb-1 font-bold">F</div>

                <div class="flex items-center text-left"> {{ game.season.team.college_abbreviation }} </div>
                <div>
                    <span class="sr-only">
                        {{ game.season.team.college_abbreviation }} Score Q1
                    </span>
                    {{ game.our_score_q1 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.season.team.college_abbreviation }} Score Q2
                    </span>
                    {{ game.our_score_q2 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.season.team.college_abbreviation }} Score Q3
                    </span>
                    {{ game.our_score_q3 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.season.team.college_abbreviation }} Score Q4
                    </span>
                    {{ game.our_score_q4 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.season.team.college_abbreviation }} Score OT
                    </span>
                    {{ game.our_score_ot }}
                </div>
                <div class="font-bold flex items-center justify-center">
                    {{ game.our_score }}
                </div>

                <div class="flex items-center text-left">
                    {{ game.opp_team.college_abbreviation }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.opp_team.college_abbreviation }} Score Q1
                    </span>
                    {{ game.opp_score_q1 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.opp_team.college_abbreviation }} Score Q2
                    </span>
                    {{ game.opp_score_q2 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.opp_team.college_abbreviation }} Score Q3
                    </span>
                    {{ game.opp_score_q3 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.opp_team.college_abbreviation }} Score Q4
                    </span>
                    {{ game.opp_score_q4 }}
                </div>
                <div>
                    <span class="sr-only">
                        {{ game.opp_team.college_abbreviation }} Score OT
                    </span>
                    {{ game.opp_score_ot }}
                </div>
                <div class="font-bold flex items-center justify-center">
                    {{ game.opp_score }}
                </div>
            </div>
        </Card>
    </AppLayout>
</template>
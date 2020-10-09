<template>
    <div class="text-center">
        <h1 class="text-center">{{ $t('app.admin.title') }}</h1>
        <p class="block mt-3 mb-3">{{ $t('app.admin.intro') }}</p>
        <b-container>
        <b-row>
            <b-col>
                <b-card :title="$t('app.admin.locations.title')" img-src="" img-alt="" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                    <b-card-text>
                        {{ $t('app.admin.locations.description') }}
                    </b-card-text>
                    <b-button :to="{ name: 'admin_location_index' }" variant="primary">Verwalten</b-button>
                </b-card>
            </b-col>
            <b-col>
                <b-card :title="$t('app.admin.bookings.title')" img-src="" img-alt="" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                    <b-card-text>
                        {{ $t('app.admin.bookings.description') }}
                    </b-card-text>
                    <b-button :to="{ name: 'admin_booking_index' }" variant="primary">Verwalten</b-button>
                </b-card>
            </b-col>
            <b-col>
                <b-card :title="$t('app.admin.permissions.title')" img-src="" img-alt="" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                    <b-card-text>
                        {{ $t('app.admin.permissions.description') }}
                    </b-card-text>
                    <b-button :to="{ name: 'admin_permission_index' }" variant="primary">Verwalten</b-button>
                </b-card>
            </b-col>
            <b-col>
                <b-card :title="$t('app.admin.statistics.title')" img-src="" img-alt="" img-top tag="article" style="max-width: 20rem;" class="mb-2">
                    <b-card-text>
                        {{ $t('app.admin.statistics.description') }}
                    </b-card-text>
                    <b-button :to="{ name: 'admin_statistic_index' }" variant="primary">Verwalten</b-button>
                </b-card>
            </b-col>
        </b-row>
        </b-container>
    </div>
</template>

<script>
    export default {
        name: "AdminIndex",
    }
</script>

<style scoped>

</style>

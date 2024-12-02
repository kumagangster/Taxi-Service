<template>
    <div>
        <div ref="map" class="map"></div>
    </div>
</template>
<style scoped>
.map {
    width: 100%;
    height: 400px;
}
</style>
<script>
import 'ol/ol.css';
import { Map, View } from 'ol';
import TileLayer from 'ol/layer/Tile';
import OSM from 'ol/source/OSM';

export default {
    data() {
        return {
            map: null,
        };
    },
    mounted() {
        this.initMap();
    },
    methods: {
        initMap() {
            // Create a new map
            this.map = new Map({
                target: this.$refs.map,
                layers: [
                    new TileLayer({
                        source: new OSM(),
                    }),
                ],
                view: new View({
                    center: [0, 0],
                    zoom: 2,
                }),
            });
        },
    },
};
</script>

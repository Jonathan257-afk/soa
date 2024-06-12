<template>
    <div class="sidebar">
        <div class="sidebar-background"></div>
			<div class="sidebar-wrapper scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav">

						<li class="nav-item" id="dashboard-nav">
							<router-link @click="changeView('dashboard-nav')" to="/">
								<i class="fas fa-atlas"></i>
								<p>Tableau de bord</p>
							</router-link>
						</li>

						<li class="nav-item" id="house-nav">
							<router-link @click="changeView('house-nav')" to="/house">
								<i class="fas fa-warehouse"></i>
								<p>Maison</p>
							</router-link>
						</li>
						<li class="nav-item" id="message-nav">
							<router-link @click="changeView('message-nav')" to="/message">
								<i class="fas fa-envelope"></i>
								<p>Message</p>
							</router-link>
						</li>
					</ul>
				</div>
			</div>
    </div>
</template>


<script>
import axios from 'axios';
import helper from '../../../helper';

export default {
	data(){
		return {
		}
	},

    methods: {
		setId(idString, id) {
			return idString + id;
		},

        changeView(idNvav, url = null){
			$(".sidebar-content  .nav .nav-item").removeClass("active");
			$(".sidebar-content  .nav .nav-item").removeClass("submenu");
            $(".sidebar-content  .nav #"+idNvav).addClass("active");

			if(url != null) {
				this.$router.push(url);
			}
		},

		setId(id) {
			return id;
		},
    },
}
</script>

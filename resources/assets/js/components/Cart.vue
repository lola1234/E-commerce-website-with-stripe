<template>
	<div class="row">
		<div v-for="item in cart">		
				  					
						
			<p class="text-center"><b>{{ item.name }}</b></p>
			<p class="text-center"><b>€{{ item.price }}</b></p>				
        
		</div>
	</div>
	
</template>

<script>
	export default{
		created(){			
			this.cart();		
		},
		
		methods:{
			cart(){
				this.$store.state.cart;		
			}
		},
		computed:{
			incr(){
				this.$store.commit('incrqty', this.product.id)
			},
			decr(){
				this.$store.commit('decrqty', this.product.id)		
			}
		}
	
	}
</script>
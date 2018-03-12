import Vuex from 'vuex'
import Vue from 'vue'

Vue.use(Vuex)

export const store = new Vuex.Store({
	state:{		
		cart:[]		
	},
	
	getters:{
		cartLength(state){
			return state.cart.length
		},
		
		cart(state){
			return state.cart
		}
	},
	
	mutations:{
		
		ADD(state, item){
			state.cart.push(item)
		},
		INCR_QTY(state, id){
			const product = state.cart.find((p) =>{
				return p.id == id
			})
			if(product){
				product.qty++
				product.total = product.qty * product.price
			}
			
		},
		DECR_QTY(state, id){
			const product = state.cart.find((p) =>{
				return p.id === id
			})
			product.qty--
			product.total = product.qty * product.price
		},
	}
	
	
})
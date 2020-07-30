
import createPersistedState from "vuex-persistedstate";

const url = "http://localhost:8000/api/";

var headers = new Headers();
headers.append("Content-Type","application/json");

const status = response => (response.status >= 200 && response.status < 300) ? Promise.resolve(response) : Promise.reject((response.statusText));

export default {

  state: {
    poks : [],
    pok : {}
  },
  
  mutations: {
    setPoks(state, poks) {
      state.poks = poks;
    },
    setPok(state, pok) {
      state.pok = pok;
    },
  },

  actions: {    

    async getPoks(state) {

      const poksRaw = await fetch(url+"pokemons", { headers: { 
          "Content-Type": "application/json"
        }  
      });

      const validPoks = await status(poksRaw)

      const poks = await validPoks.json();

      state.commit("setPoks", poks.data );
      
    },

    async getPok(state, id) {

      const pokRaw = await fetch(url+"pokemons/"+id, { headers: { 
          "Content-Type": "application/json"
        }  
      });

      const validPok = await status(pokRaw)

      const pok = await validPok.json();

      state.commit("setPok", pok.data[0].Pokemon );
      
    },
  },
  
  
  modules: {
  },

  getters: {

    getPoks(state) {
      return state.poks;
    },

    getPok(state) {
      return state.pok;
    }
  },

  plugins: [createPersistedState()]
}

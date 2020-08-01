
import createPersistedState from "vuex-persistedstate";

const url = "http://localhost:8000/api/";

var headers = new Headers();
headers.append("Content-Type","application/json");

const status = response => (response.status >= 200 && response.status < 300) ? Promise.resolve(response) : Promise.reject((response.statusText));

export default {

  state: {
    poks : [],
    pok : {},
    evolPok : {},
    users :[],
    teams: []
  },
  
  mutations: {
    setPoks(state, poks) {
      state.poks = poks;
    },
    setPok(state, pok) {
      state.pok = pok;
    },
    setEvolPok(state, evolPok) {
      state.evolPok = evolPok;
    },
    setUsers(state, users){
      state.users=users;
     },
     setTeams(state,teams){
       state.teams=teams;
     }
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

      if (pok.data[0].Pokemon.evolutions.evolution_id) state.dispatch("getEvolPok", pok.data[0].Pokemon.evolutions.evolution_id)
      
    },

    async getEvolPok(state, id) {

      const pokEvolRaw = await fetch(url+"pokemons/"+id, { headers: { 
          "Content-Type": "application/json"
        }  
      });

      const validEvolPok = await status(pokEvolRaw)

      const evolPok = await validEvolPok.json();

      state.commit("setEvolPok", evolPok.data[0].Pokemon );
      
    },
    async getUsers(state) {

      const usersRaw = await fetch(url+"users", { headers: { 
          "Content-Type": "application/json"
        }  
      });
     
      const validUsers = await status(usersRaw);

      const users = await validUsers.json();

      state.commit("setUsers", users.users );
      
    },
      async getTeams(state){

      let teams= [];

      for (let user of state.users)
      {
        const teamRaw = await fetch(url+"users/"+user.id+"/team" ,{ headers: { 
          "Content-Type": "application/json"
        }});

        const validTeam = await status(teamRaw);
        const team = await validTeam.json();
        teams.push('team');
      }

        state.commit("setTeams",teams.data);
    }
  },

  
  
  modules: {
  },

  getters: {

    getPoks(state) {
      return state.poks;
    },
    getPok(state) {
      return state.pok;
    },
    getEvolPok(state) {
      return state.evolPok;
    },

    getUsers(state) {
      return state.users;
    },
    getTeams(state){
      return state.teams;
    }
  },

  plugins: [createPersistedState()]
}

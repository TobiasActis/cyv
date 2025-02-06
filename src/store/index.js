import { createStore } from 'vuex';

export default createStore({
  state: {
    excelData: []
  },
  mutations: {
    setExcelData(state, data) {
      state.excelData = data;
    },
    clearExcelData(state) {
      state.excelData = [];
    }
  },
  actions: {
    updateExcelData({ commit }, data) {
      commit('setExcelData', data);
    }
  },
  getters: {
    getExcelData: (state) => state.excelData
  }
});

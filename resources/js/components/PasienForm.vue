<template>
  <div class="row">
    <input
      id="nama"
      type="text"
      name="nama"
      class="form-control input-sm mb-2"
      placeholder="Nama Pasien"
      v-model="nama"
    />

    <select
      id="jenis_obat"
      name="jenis_obat"
      class="form-control custom-select input-sm mb-2"
      v-model="jenis_obat"
    >
      <option disabled value="">Jenis Obat</option>
      <option value="Racikan">Racikan</option>
      <option value="Non-Racikan">Non-Racikan</option>
    </select>

    <select
      id="jenis_pasien"
      name="jenis_pasien"
      class="form-control custom-select input-sm mb-2"
      v-model="jenis_pasien"
    >
      <option disabled value="">Jenis Pasien</option>
      <option value="BPJS">BPJS</option>
      <option value="Umum">Umum</option>
      <option value="Perusahaan">Perusahaan</option>
    </select>

    <button
      class="btn btn-primary btn-sm float-right"
      id="btn-chat"
      @click="createPasien"
    >
      Kirim
    </button>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nama: "",
      jenis_obat: "",
      jenis_pasien: "",
    };
  },

  methods: {
    createPasien() {
      var pasien = {
        nama: this.nama,
        jenis_obat: this.jenis_obat,
        jenis_pasien: this.jenis_pasien,
      };
      console.log(pasien);
      this.$emit("pasiencreated", pasien);

      this.nama = "";
      this.jenis_obat = "";
      this.jenis_pasien = "";
      console.log(this.jenis_pasien);
    },
  },
};
</script>

<template>
  <div class="row">
    <input
      id="nama"
      type="text"
      name="nama"
      :class="`form-control input-sm mb-2 ${
        errors.nama ? 'form-control-danger' : ''
      }`"
      placeholder="Nama Pasien"
      v-model="form.nama"
    />

    <select
      id="jenis_obat"
      name="jenis_obat"
      :class="`form-control custom-select input-sm mb-2 ${
        errors.jenis_obat ? 'form-control-danger' : ''
      }`"
      v-model="form.jenis_obat"
    >
      <option disabled value="">Jenis Obat</option>
      <option value="Racikan">Racikan</option>
      <option value="Non-Racikan">Non-Racikan</option>
    </select>

    <select
      id="jenis_pasien"
      name="jenis_pasien"
      :class="`form-control custom-select input-sm mb-2 ${
        errors.jenis_pasien ? 'form-control-danger' : ''
      }`"
      v-model="form.jenis_pasien"
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
      form: {
        nama: "",
        jenis_obat: "",
        jenis_pasien: "",
      },
      errors: {
        nama: false,
        jenis_obat: false,
        jenis_pasien: false,
      },
    };
  },

  methods: {
    createPasien() {
      if (this.validate()) {
        const pasien = this.form;
        this.$emit("pasiencreated", pasien);

        this.form = {
          nama: "",
          jenis_obat: "",
          jenis_pasien: "",
        };
      }
    },
    validate() {
      _.forEach(this.form, (val, key) => {
        this.errors[key] = val === "";
      });
      return !Object.values(this.errors).includes(true);
    },
  },
};
</script>

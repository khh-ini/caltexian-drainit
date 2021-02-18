package com.azizapp.test.ui.laporan

import android.app.Activity.RESULT_OK
import android.content.Intent
import android.content.Intent.getIntent
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import android.widget.Toast.LENGTH_LONG
import android.widget.Toast.LENGTH_SHORT
import androidx.activity.viewModels
import androidx.fragment.app.Fragment
import androidx.fragment.app.activityViewModels
import androidx.fragment.app.viewModels
import androidx.lifecycle.Observer
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentNamaJalanBinding
import com.azizapp.test.utill.Session
import com.google.android.material.bottomsheet.BottomSheetDialog
import kotlinx.android.synthetic.main.bottom_sheet_dialog.view.*
import kotlinx.android.synthetic.main.fragment_laporan.*
import kotlinx.android.synthetic.main.fragment_laporan.view.*


class LaporanFragment : Fragment() {

    private lateinit var jenisPengaduan: String



    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {

        //pilihLaporan()
        val inflater = inflater.inflate(R.layout.fragment_laporan, container, false)
        //tv_laporkan?.setText("Laporkan $jenisPengaduan")

        inflater.editTextNamaJalan.setOnClickListener {
            val intent = Intent(activity, LaporanActivity::class.java)
            startActivityForResult(intent, 100)
        }

        return inflater
    }

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        if (!Session.namaJalan.isNullOrEmpty()){
            editTextNamaJalan.setText(Session.namaJalan)
            Toast.makeText(context,Session.namaJalan,LENGTH_SHORT).show()
        }

    }

    override fun onActivityResult(requestCode: Int, resultCode: Int, data: Intent?) {

        if (requestCode == 100 && resultCode == RESULT_OK && data != null) {
            val lat = data.getDoubleExtra("LAT",0.0)
            val long = data.getDoubleExtra("LONG",0.0)
            editTextNamaJalan.setText(data.getStringExtra("ADDRESS"))
            editTextLokasi.setText("[$lat,$long]")
        }
    }
    fun pilihLaporan() {
        val view = layoutInflater.inflate(R.layout.bottom_sheet_dialog, null)
        val dialog = BottomSheetDialog(requireActivity())
        dialog.setContentView(view)
        dialog.show()

        view.titik_tersumbat.setOnClickListener{
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Tersumbat", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
            jenisPengaduan = "Titik Tersumbat"
        }

        view.titik_banjir.setOnClickListener{
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Banjir", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
            jenisPengaduan = "Titik Banjir"
        }
    }
}
package com.azizapp.test.ui.laporan

import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.Toast
import androidx.fragment.app.Fragment
import com.azizapp.test.R
import com.google.android.material.bottomsheet.BottomSheetDialog
import kotlinx.android.synthetic.main.bottom_sheet_dialog.view.*
import kotlinx.android.synthetic.main.fragment_laporan.*
import kotlinx.android.synthetic.main.fragment_laporan.view.*


class LaporanFragment : Fragment() {

    lateinit var jenisPengaduan: String

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        pilihLaporan()
        jenisPengaduan = ""
        val i = inflater.inflate(R.layout.fragment_laporan, container, false)
        i.tv_laporkan?.setText("Laporkan " + jenisPengaduan)
        return i
    }

    private fun pilihLaporan() {
        val view = layoutInflater.inflate(R.layout.bottom_sheet_dialog, null)
        val dialog = BottomSheetDialog(requireActivity())
        dialog.setContentView(view)
        dialog.show()

        view.titik_tersumbat.setOnClickListener {
            jenisPengaduan = "Titik Tersumbat"
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Tersumbat", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
        }

        view.titik_banjir.setOnClickListener {
            jenisPengaduan = "Titik Banjir"
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Banjir", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
        }
    }
}
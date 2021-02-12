package com.azizapp.test.fragment

import android.graphics.Color
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.appcompat.widget.AppCompatSpinner
import androidx.fragment.app.Fragment
import com.azizapp.test.R
import com.google.android.material.bottomsheet.BottomSheetBehavior
import com.google.android.material.bottomsheet.BottomSheetDialog
import kotlinx.android.synthetic.main.bottom_sheet_dialog.*
import kotlinx.android.synthetic.main.bottom_sheet_dialog.view.*
import java.lang.StringBuilder


class LaporanFragment : Fragment() {

    private lateinit var jenisPengaduan: String

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        pilihLaporan()

        val i = inflater.inflate(R.layout.fragment_laporan, container, false)
//        val languages = resources.getStringArray(R.array.TipePengaduan)
//        val spinner = i.findViewById<AppCompatSpinner>(R.id.spinnerTipePengaduan)
//            val adapter = ArrayAdapter(
//                activity!!,
//                    R.layout.support_simple_spinner_dropdown_item, languages
//            )
//            spinner.adapter = adapter
//            spinner.onItemSelectedListener = object :
//                    AdapterView.OnItemSelectedListener {
//                override fun onItemSelected(
//                    parent: AdapterView<*>,
//                    view: View, position: Int, id: Long
//                ) {
//                    (parent.getChildAt(0) as TextView).setTextColor(Color.GRAY)
//                    Toast.makeText(
//                        activity,
//                        "Anda melaporkan" +
//                                "" + languages[position], Toast.LENGTH_SHORT
//                    ).show()
//                }
//
//                override fun onNothingSelected(parent: AdapterView<*>) {
//                    // write code to perform some action
//                }
//        //return i
//            }
        return i
    }

    private fun pilihLaporan() {
        val view = layoutInflater.inflate(R.layout.bottom_sheet_dialog, null)
        val dialog = BottomSheetDialog(activity!!)
        dialog.setContentView(view)
        dialog.show()

        view.titik_tersumbat.setOnClickListener{
            jenisPengaduan = "Titik Tersumbat"
            Toast.makeText(
                        activity,
                        "Anda melaporkan Titik Tersumbat", Toast.LENGTH_SHORT
                    ).show()
            dialog.dismiss()
        }

        view.titik_banjir.setOnClickListener{
            jenisPengaduan = "Titik Banjir"
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Banjir", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
        }
    }
}
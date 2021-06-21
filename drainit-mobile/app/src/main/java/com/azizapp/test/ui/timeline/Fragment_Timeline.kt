package com.azizapp.test.ui.timeline

import androidx.lifecycle.ViewModelProvider
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import com.azizapp.test.R

class Fragment_Timeline : Fragment() {

    companion object {
        fun newInstance() = Fragment_Timeline()
    }

    private lateinit var viewModel: FragmentTimelineViewModel

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        return inflater.inflate(R.layout.fragment__timeline_fragment, container, false)
    }

    override fun onActivityCreated(savedInstanceState: Bundle?) {
        super.onActivityCreated(savedInstanceState)
        viewModel = ViewModelProvider(this).get(FragmentTimelineViewModel::class.java)
        // TODO: Use the ViewModel
    }

}
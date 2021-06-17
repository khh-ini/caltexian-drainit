package com.azizapp.test;

import android.app.Activity;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;

import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.model.Marker;


public class CustomInfoWindowAdapter implements GoogleMap.InfoWindowAdapter {
    private final Activity context;

    public CustomInfoWindowAdapter(Activity context) {
        this.context = context;

    }

    private void renderWindowText(Marker marker, View view) {
        String title = marker.getTitle();
        TextView tvTitle = (TextView) view.findViewById(R.id.tvTitleMarker);
        if (!title.equals("")) {
            tvTitle.setText(title);
        }

        String snippet = marker.getSnippet();
        TextView tvSnippet = (TextView) view.findViewById(R.id.tvSnippet);
        if (!snippet.equals("")) {
            tvSnippet.setText(snippet);
        }
    }

    @Override
    public View getInfoWindow(Marker marker) {
        return null;
    }


    @Override
    public View getInfoContents(Marker marker) {
        View view = context.getLayoutInflater().inflate(R.layout.custom_info_layout, null);

        ImageView imageView = (ImageView) view.findViewById(R.id.imageInfo);
        TextView tvTitle = (TextView) view.findViewById(R.id.tvTitleMarker);
        TextView tvSubTitle = (TextView) view.findViewById(R.id.tvSnippet);


        tvTitle.setText(marker.getTitle());
        tvSubTitle.setText(marker.getSnippet());

        return view;
    }
}

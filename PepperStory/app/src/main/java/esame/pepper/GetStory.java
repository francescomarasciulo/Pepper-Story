package esame.pepper;

import android.app.ProgressDialog;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.widget.ImageView;
import com.aldebaran.qi.sdk.QiContext;
import com.aldebaran.qi.sdk.QiSDK;
import com.aldebaran.qi.sdk.RobotLifecycleCallbacks;
import com.aldebaran.qi.sdk.builder.SayBuilder;
import com.aldebaran.qi.sdk.design.activity.RobotActivity;
import com.aldebaran.qi.sdk.design.activity.conversationstatus.SpeechBarDisplayPosition;
import com.aldebaran.qi.sdk.design.activity.conversationstatus.SpeechBarDisplayStrategy;
import com.aldebaran.qi.sdk.object.conversation.Phrase;
import com.aldebaran.qi.sdk.object.conversation.Say;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.ArrayList;

public class GetStory extends RobotActivity implements RobotLifecycleCallbacks {

    private ImageView imageView;
    private ArrayList<Bitmap> imageList = new ArrayList<>();
    private ArrayList<String> story = new ArrayList<>();
    private ArrayList<String> color = new ArrayList<>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.get_story);

        imageView = findViewById(R.id.imageView);

        getStory();

        //QiSDK.register(this, this);
    }

    private void getStory() {

        class GetParagraphs extends AsyncTask<String, Void, String> {
            ProgressDialog loading;

            @Override
            protected String doInBackground(String... params) {
                String table = params[0];
                Log.d("prova", "prova tabella: " +table);
                try {
                    URL url = new URL ("https://pepper4storytelling.altervista.org/Cartella%20temporanea%20GETTERS/get_paragraph.php");
                    HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoInput(true);
                    httpURLConnection.setDoOutput(true);
                    OutputStream outputStream = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                    String sendData = URLEncoder.encode("table", "UTF-8")+"="+URLEncoder.encode(table, "UTF-8");
                    bufferedWriter.write(sendData);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                    StringBuilder sb = new StringBuilder();
                    String line = "";
                    while ((line = bufferedReader.readLine()) != null) {
                        sb.append(line).append('\n');
                    }
                    JSONArray jsonArray = new JSONArray(sb.toString());
                    for (int i=0; i < jsonArray.length(); i++ ) {
                        JSONObject ob = jsonArray.getJSONObject(i);
                        story.add(i, ob.get("Testo").toString());
                    }
                    bufferedReader.close();
                    inputStream.close();
                    httpURLConnection.disconnect();
                    return sb.toString();
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(GetStory.this, "", "Caricamento storia in corso...", true, true);
            }

            @Override
            protected void onPostExecute(String b) {
                super.onPostExecute(b);
                Log.d("prova", "prova testo paragrafi: " +story);
                for (int i=0; i < story.size(); i++ ) {
                    getImage(i);
                }
                getColor();
                loading.dismiss();
            }

        }

        GetParagraphs getParagraphs = new GetParagraphs();
        getParagraphs.execute(""+PepperStory.storyTitle);
    }

    private void getImage(int id) {

        class GetImage extends AsyncTask<String, Void, Bitmap> {

            @Override
            protected Bitmap doInBackground(String... params) {
                String table = params[0];
                String id = params[1];
                Log.d("prova", "prova tabella: " +table);
                Log.d("prova", "prova id: " +id);
                Bitmap image = null;
                try {
                    URL url = new URL ("https://pepper4storytelling.altervista.org/Cartella%20temporanea%20GETTERS/get_image.php");
                    HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoInput(true);
                    httpURLConnection.setDoOutput(true);
                    OutputStream outputStream = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                    String sendData = URLEncoder.encode("table", "UTF-8")+"="+URLEncoder.encode(table, "UTF-8")+"&"+URLEncoder.encode("id", "UTF-8")+"="+URLEncoder.encode(id, "UTF-8");
                    bufferedWriter.write(sendData);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    image = BitmapFactory.decodeStream(inputStream);
                    imageList.add(Integer.parseInt(id), image);
                    inputStream.close();
                    httpURLConnection.disconnect();
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                }
                return image;
            }

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
            }

            @Override
            protected void onPostExecute(Bitmap b) {
                super.onPostExecute(b);
                Log.d("prova", "prova disegno bitmap: " +imageList);
                Log.d("temp", "valore id: "+id);
                Log.d("temp", "valore storysize: "+story.size());
                //MODIFICA TEMPORANEA
                /*if(id == story.size()-1) {
                    Log.d("temp", "SONO DENTRO");
                    startTalk();
                }*/
            }

        }

        GetImage getImage = new GetImage();
        getImage.execute(""+PepperStory.storyTitle, ""+id);

    }

    private void getColor() {

        class GetColor extends AsyncTask<String, Void, String> {

            @Override
            protected String doInBackground(String... params) {
                String table = params[0];
                Log.d("prova", "prova tabella: " +table);
                try {
                    URL url = new URL ("https://pepper4storytelling.altervista.org/Cartella%20temporanea%20GETTERS/get_color.php");
                    HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoInput(true);
                    httpURLConnection.setDoOutput(true);
                    OutputStream outputStream = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                    String sendData = URLEncoder.encode("table", "UTF-8")+"="+URLEncoder.encode(table, "UTF-8");
                    bufferedWriter.write(sendData);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream, "iso-8859-1"));
                    StringBuilder sb = new StringBuilder();
                    String line = "";
                    while ((line = bufferedReader.readLine()) != null) {
                        sb.append(line).append('\n');
                    }
                    JSONArray jsonArray = new JSONArray(sb.toString());
                    for (int i=0; i < jsonArray.length(); i++ ) {
                        JSONObject ob = jsonArray.getJSONObject(i);
                        color.add(i, ob.get("Colore").toString());
                    }
                    bufferedReader.close();
                    inputStream.close();
                    httpURLConnection.disconnect();
                    return sb.toString();
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                } catch (JSONException e) {
                    e.printStackTrace();
                }
                return null;
            }

            @Override
            protected void onPreExecute() {
                super.onPreExecute();
            }

            @Override
            protected void onPostExecute(String b) {
                super.onPostExecute(b);
                Log.d("prova", "prova array colori: " +color);
                startTalk();
            }

        }

        GetColor getColor = new GetColor();
        getColor.execute(""+PepperStory.storyTitle);
    }

    //CREARE UNA NUOVA CLASSE CHE IMPLEMENTA RobotLifecycleCallbacks, CREARE UN NUOVO OGGETTO DI QUELLA CLASSE ED AVVIARLO
    //ALL'INTERNO DELLA FUNZIONE STARTTALK
    public void startTalk() {
        //GetStory getStory = new GetStory();
        //new Thread(getStory).start();
        setSpeechBarDisplayStrategy(SpeechBarDisplayStrategy.IMMERSIVE);
        setSpeechBarDisplayPosition(SpeechBarDisplayPosition.TOP);
        QiSDK.register(this, this);
        Log.d("temp", "SONO DENTRO FLAG");
    }

    @Override
    public void onBackPressed() {
        startActivity(new Intent(GetStory.this, PepperStory.class));
        finish();
    }

    @Override
    public void onRobotFocusGained(QiContext qiContext) {
        Log.d("prova", "valore array paragrafi: " +story.size());
        Log.d("prova", "valore array immagini: " +imageList.size());
        //FUNZIONA PRIMA DI AGGIUNTA COLORE
        /*for (int i = 0; i < story.size(); i++) {
            Log.d("prova", "prova bitmap: " +imageList.get(i));
            int index = i;
            runOnUiThread(() -> imageView.setImageBitmap(imageList.get(index)));
            Phrase paragrafo = new Phrase("" + story.get(i));
            Log.d("prova", "prova frase: " +paragrafo);
            Say say = SayBuilder.with(qiContext).withPhrase(paragrafo).build();
            say.run();
        }*/
        //PROVA CON COLORE
        for (int i = 0; i < story.size(); i++) {
            Log.d("prova", "prova bitmap: " +imageList.get(i));
            int index = i;
            if(imageList.get(i) != null) {
                runOnUiThread(() -> imageView.setBackgroundColor(255));
                runOnUiThread(() -> imageView.setImageBitmap(imageList.get(index)));
            }
            else {
                //runOnUiThread(() -> imageView.setImageBitmap(imageList.get(index)));
                /*Log.d("COLORE", "COLORE: " +color.get(index));
                String colorDefault = "#92A8D2";
                if(color.get(index) == colorDefault) {
                    //SETTARE IMMAGINE DEFAULT
                    Bitma
                    runOnUiThread(() -> imageView.setImageDrawable();
                } else {
                    runOnUiThread(() -> imageView.setBackgroundColor(Color.parseColor(color.get(index))));
                }*/
                runOnUiThread(() -> imageView.setImageBitmap(null));
                runOnUiThread(() -> imageView.setBackgroundColor(Color.parseColor(color.get(index))));
            }
            Phrase paragrafo = new Phrase("" + story.get(i));
            Log.d("prova", "prova frase: " +paragrafo);
            Say say = SayBuilder.with(qiContext).withPhrase(paragrafo).build();
            say.run();
        }
    }

    @Override
    public void onRobotFocusLost() {

    }

    @Override
    public void onRobotFocusRefused(String reason) {

    }

    @Override
    protected void onDestroy() {
        QiSDK.unregister(this, this);
        super.onDestroy();
    }

}

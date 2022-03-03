import wx
import text_to_speech
from coreEngine import search_controls


def SendCurrQuestion(curr_question):
    return testchatbot.getAnswer(curr_question)


class ChatterJackFrame(wx.Frame):
    """ This is a class for setting the parameters of where and
    what the widgets will be doing on the main window"""

    def __init__(self, parent_app, title):
        wx.Frame.__init__(self, parent_app, -1, title,
                          pos=(0, 0), size=(wx.DisplaySize()))

        # Create the Panel to put the widgets on.
        panel = wx.Panel(self)
        # Sets a base line for text font
        self.font = wx.Font(20, family=wx.FONTFAMILY_MODERN, style=0, weight=90,
                            underline=False, faceName="", encoding=wx.FONTENCODING_DEFAULT)
        # A text line that the ChatBot will be using to reply (closed caption)
        self.bot_txt = wx.StaticText(panel, -1, "Hello how can I help you today?")
        self.bot_txt.SetFont(self.font)
        # Button for user to click when answer is properly inserted in the txt_box
        sub_btn = wx.Button(panel, -1, "Submit")
        # A text box for the user to input their question into.
        self.txt_box = wx.TextCtrl(panel, -1, "Ask Your Question Here...", size=(200, -1))

        # bind the button event to it's handler function
        self.Bind(wx.EVT_BUTTON, self.OnTimeToSubmit, sub_btn)

        # Use a sizer to layout the controls, stacked vertically and with
        # a 10 pixel border around each
        sizer = wx.BoxSizer(wx.VERTICAL)
        sizer.Add(self.bot_txt, 0, wx.ALL, 10)
        sizer.Add(sub_btn, 0, wx.ALL, 10)
        sizer.Add(self.txt_box, 0, wx.ALL, 10)
        panel.SetSizer(sizer)
        panel.Layout()

    def OnTimeToSubmit(self, evt):
        """Event handler for the Submit button click."""
        return_str = SendCurrQuestion(self.txt_box.GetValue())
        # return answer as test-to-speech and a closed caption
        self.bot_txt.SetLabelText(return_str)
        text_to_speech.return_str_as_speech(return_str)


class MyApp(wx.App):
    def OnInit(self):
        frame = ChatterJackFrame(None, "ChatterJack ChatBot")
        self.SetTopWindow(frame)
        frame.Show(True)
        return True


app = MyApp(redirect=True)
app.MainLoop()

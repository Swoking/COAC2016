#ifndef OVERLAY_H
#define OVERLAY_H

#include <QRect>
#include <QWidget>
#include <QPainter>


class Overlay : public QWidget
{
public:
    Overlay(QWidget *parent = 0) : QWidget(parent){
        //setAttribute(Qt::WA_NoSystemBackground);
        //setWindowFlags(Qt::FramelessWindowHint /*| Qt::SplashScreen*/);
        //setAttribute(Qt::WA_TranslucentBackground);
    }
protected:
    void paintEvent(QPaintEvent *) {
        QPainter p(this);
        p.fillRect(rect(), QColor(0, 0, 0, 255));
    }
};

#endif // OVERLAY_H
